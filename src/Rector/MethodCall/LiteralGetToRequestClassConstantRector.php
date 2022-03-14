<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\NodeAnalyzer\LiteralCallLikeConstFetchReplacer;
use Rector\Symfony\ValueObject\ConstantMap\SymfonyRequestConstantMap;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\MethodCall\LiteralGetToRequestClassConstantRector\LiteralGetToRequestClassConstantRectorTest
 */
final class LiteralGetToRequestClassConstantRector extends AbstractRector
{
    public function __construct(
        private readonly LiteralCallLikeConstFetchReplacer $literalCallLikeConstFetchReplacer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Replace "GET" string by Symfony Request object class constants', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Component\Form\FormBuilderInterface;

final class SomeClass
{
    public function detail(FormBuilderInterface $formBuilder)
    {
        $formBuilder->setMethod('GET');
    }
}
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
use Symfony\Component\Form\FormBuilderInterface;

final class SomeClass
{
    public function detail(FormBuilderInterface $formBuilder)
    {
        $formBuilder->setMethod(\Symfony\Component\HttpFoundation\Request::GET);
    }
}
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class, StaticCall::class];
    }

    /**
     * @param MethodCall|StaticCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof StaticCall) {
            return $this->refactorStaticCall($node);
        }

        if ($this->isObjectType($node->var, new ObjectType('Symfony\Component\HttpKernel\Client'))) {
            return $this->refactorClientMethodCall($node);
        }

        if (! $this->isObjectType($node->var, new ObjectType('Symfony\Component\Form\FormBuilderInterface'))) {
            return null;
        }

        if (! $this->isName($node->name, 'setMethod')) {
            return null;
        }

        return $this->literalCallLikeConstFetchReplacer->replaceArgOnPosition(
            $node,
            0,
            'Symfony\Component\HttpFoundation\Request',
            SymfonyRequestConstantMap::METHOD_TO_CONST
        );
    }

    private function refactorStaticCall(StaticCall $staticCall): StaticCall|null
    {
        if (! $this->isObjectType($staticCall->class, new ObjectType('Symfony\Component\HttpFoundation\Request'))) {
            return null;
        }

        if (! $this->isName($staticCall->name, 'create')) {
            return null;
        }

        return $this->literalCallLikeConstFetchReplacer->replaceArgOnPosition(
            $staticCall,
            1,
            'Symfony\Component\HttpFoundation\Request',
            SymfonyRequestConstantMap::METHOD_TO_CONST
        );
    }

    private function refactorClientMethodCall(MethodCall $methodCall): MethodCall|null
    {
        if (! $this->isName($methodCall->name, 'request')) {
            return null;
        }

        return $this->literalCallLikeConstFetchReplacer->replaceArgOnPosition(
            $methodCall,
            0,
            'Symfony\Component\HttpFoundation\Request',
            SymfonyRequestConstantMap::METHOD_TO_CONST
        );
    }
}
