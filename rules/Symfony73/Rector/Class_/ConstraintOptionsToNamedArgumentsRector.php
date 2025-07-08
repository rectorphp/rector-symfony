<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ConstraintOptionsToNamedArgumentsRector extends AbstractRector
{
    public function __construct(
        private readonly ValueResolver $valueResolver,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Refactor Symfony constraints using array options to named arguments syntax for better readability and type safety.',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\Validator\Constraints\NotBlank;

$constraint = new NotBlank(['message' => 'This field should not be blank.']);
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\Validator\Constraints\NotBlank;

$constraint = new NotBlank(message: 'This field should not be blank.');
CODE_SAMPLE
                )]
        );
    }

    public function getNodeTypes(): array
    {
        return [New_::class];
    }

    public function refactor(Node $node): ?Node
    {
        if (! $node instanceof New_) {
            return null;
        }

        // Match classes starting with Symfony\Component\Validator\Constraints\
        if (! $node->class instanceof FullyQualified && ! $node->class instanceof Name) {
            return null;
        }

        $className = $this->getName($node->class);
        if (! is_string($className)) {
            return null;
        }

        if (! str_starts_with($className, 'Symfony\Component\Validator\Constraints\\')) {
            return null;
        }

        if (
            count($node->args) === 0 ||
            ! $node->args[0] instanceof Arg ||
            ! $node->args[0]->value instanceof Array_
        ) {
            return null;
        }

        $argName = $node->args[0]->name;
        if ($argName !== null && $argName->name !== 'options') {
            return null;
        }

        $array = $node->args[0]->value;
        $namedArgs = [];

        foreach ($array->items as $item) {
            if (! $item instanceof ArrayItem || $item->key === null) {
                continue;
            }

            $keyValue = $this->valueResolver->getValue($item->key);
            if (! is_string($keyValue)) {
                continue;
            }

            $arg = new Node\Arg($item->value);
            $arg->name = new Node\Identifier($keyValue);

            $namedArgs[] = $arg;
        }

        $node->args = $namedArgs;

        return $node;
    }
}
