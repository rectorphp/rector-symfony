<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://stackoverflow.com/questions/25264922/symfony-2-5-addviolationat-deprecated-use-buildviolation
 * @see \Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\AddViolationToBuildViolationRectorTest
 */
final class AddViolationToBuildViolationRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change `$context->addViolationAt` to `$context->buildViolation` on Validator ExecutionContext',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
$context->addViolationAt('property', 'The value {{ value }} is invalid.', array(
    '{{ value }}' => $invalidValue,
));
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
$context->buildViolation('The value {{ value }} is invalid.')
    ->atPath('property')
    ->setParameter('{{ value }}', $invalidValue)
    ->addViolation();
CODE_SAMPLE
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?MethodCall
    {
        $objectType = $this->nodeTypeResolver->getType($node->var);
        if (! $objectType instanceof ObjectType) {
            return null;
        }

        $executionContext = new ObjectType('Symfony\Component\Validator\Context\ExecutionContextInterface');
        if (! $executionContext->isSuperTypeOf($objectType)->yes()) {
            return null;
        }

        if (! $this->nodeNameResolver->isName($node->name, 'addViolationAt')) {
            return null;
        }

        $args = $node->getArgs();
        $path = $args[0];
        $message = $args[1];
        $parameters = $args[2];

        $node->name = new Identifier('buildViolation');
        $node->args = [$message];
        $node = new MethodCall($node, 'atPath', [$path]);

        if ($parameters->value instanceof Array_) {
            foreach ($parameters->value->items as $item) {
                if ($item instanceof ArrayItem && $item->key instanceof Expr) {
                    $node = new MethodCall($node, 'setParameter', [new Arg($item->key), new Arg($item->value)]);
                }
            }
        }

        $node = new MethodCall($node, 'addViolation');
        return $node;
    }
}
