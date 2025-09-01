<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\Cast\Bool_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PHPStan\Type\ObjectType;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Rector\AbstractRector;
use Rector\Symfony\Enum\SymfonyClass;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\ParameterBagTypedGetMethodCallRectorTest
 */
final class ParameterBagTypedGetMethodCallRector extends AbstractRector
{
    public function __construct(
        private readonly ValueResolver $valueResolver
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Make use of specific ParameterBag::get*() method with native return type declaration',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\HttpFoundation\Request;

class SomeClass
{
    public function run(Request $request)
    {
        $debug = (bool) $request->query->get('debug', false);
    }
}
CODE_SAMPLE

                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\HttpFoundation\Request;

class SomeClass
{
    public function run(Request $request)
    {
        $debug = $request->query->getBoolean('debug');
    }
}

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
        return [MethodCall::class, Bool_::class];
    }

    /**
     * @param MethodCall|Bool_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof Bool_) {
            if (! $node->expr instanceof MethodCall) {
                return null;
            }

            return $this->refactorMethodCall($node->expr);
        }

        return null;
    }

    private function refactorMethodCall(MethodCall $methodCall): ?MethodCall
    {
        if ($methodCall->isFirstClassCallable()) {
            return null;
        }

        // default value must be defined
        if (count($methodCall->getArgs()) !== 2) {
            return null;
        }

        if (! $this->isName($methodCall->name, 'get')) {
            return null;
        }

        $callerType = $this->getType($methodCall->var);
        if (! $callerType instanceof ObjectType) {
            return null;
        }

        if (! $callerType->isInstanceOf(SymfonyClass::PARAMETER_BAG)->yes()) {
            return null;
        }

        // the getBoolean() method must exist
        if (! $callerType->hasMethod('getBoolean')->yes()) {
            return null;
        }

        $defaultArg = $methodCall->getArgs()[1];

        if ($this->valueResolver->isFalse($defaultArg->value)) {
            unset($methodCall->args[1]);
            $methodCall->name = new Identifier('getBoolean');

            return $methodCall;
        }

        return null;
    }
}
