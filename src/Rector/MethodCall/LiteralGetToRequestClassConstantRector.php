<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
<<<<<<< HEAD
use PhpParser\Node\Scalar\String_;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
=======
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\NodeAnalyzer\LiteralCallLikeConstFetchReplacer;
>>>>>>> Add LiteralGetToRequestClassConstantRector
use Rector\Symfony\ValueObject\ConstantMap\SymfonyRequestConstantMap;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\MethodCall\LiteralGetToRequestClassConstantRector\LiteralGetToRequestClassConstantRectorTest
 */
final class LiteralGetToRequestClassConstantRector extends AbstractRector
{
<<<<<<< HEAD
=======
    public function __construct(
        private LiteralCallLikeConstFetchReplacer $literalCallLikeConstFetchReplacer,
    ) {
    }

>>>>>>> Add LiteralGetToRequestClassConstantRector
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
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isObjectType($node->var, new ObjectType('Symfony\Component\Form\FormBuilderInterface'))) {
            return null;
        }

        if (! $this->isName($node->name, 'setMethod')) {
            return null;
        }

<<<<<<< HEAD
        $firstArg = $node->getArgs()[0];
        if (! $firstArg->value instanceof String_) {
            return null;
        }

        $string = $firstArg->value;
        $constantName = SymfonyRequestConstantMap::METHOD_TO_CONST[$string->value] ?? null;
        if ($constantName === null) {
            return null;
        }

        $classConstFetch = $this->nodeFactory->createClassConstFetch(
            'Symfony\Component\HttpFoundation\Request',
            $constantName
        );
        $firstArg->value = $classConstFetch;

        return $node;
=======
        return $this->literalCallLikeConstFetchReplacer->replaceArgOnPosition(
            $node,
            0,
            'Symfony\Component\HttpFoundation\Request',
            SymfonyRequestConstantMap::METHOD_TO_CONST
        );
>>>>>>> Add LiteralGetToRequestClassConstantRector
    }
}
