<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
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

        $authorizationChecker = new ObjectType('Symfony\Component\Validator\ExecutionContext');
        if (! $authorizationChecker->isSuperTypeOf($objectType)->yes()) {
            return null;
        }

        if (! $this->nodeNameResolver->isName($node->name, 'addViolationAt')) {
            return null;
        }

        return $node;
    }
}
