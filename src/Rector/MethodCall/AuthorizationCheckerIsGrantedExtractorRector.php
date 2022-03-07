<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Core\NodeAnalyzer\ArgsAnalyzer;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/symfony/symfony/blob/4.4/UPGRADE-4.4.md#security
 * @see \Rector\Symfony\Tests\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\AuthorizationCheckerIsGrantedExtractorRectorTest
 */
final class AuthorizationCheckerIsGrantedExtractorRector extends AbstractRector
{
    public function __construct(
        private readonly ArgsAnalyzer $argsAnalyzer
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Extract $this->authorizationChecker->isGranted([$a, $b]) to $this->authorizationChecker->isGranted($a) || $this->authorizationChecker->isGranted($b)',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
if ($this->authorizationChecker->isGranted(['ROLE_USER', 'ROLE_ADMIN'])) {
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
if ($this->authorizationChecker->isGranted('ROLE_USER') || $this->authorizationChecker->isGranted('ROLE_USER')) {
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
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): MethodCall|BooleanOr|null
    {
        $objectType = $this->nodeTypeResolver->getType($node->var);
        if (! $objectType instanceof ObjectType) {
            return null;
        }

        $authorizationChecker = new ObjectType(
            'Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface'
        );
        if (! $authorizationChecker->isSuperTypeOf($objectType)->yes()) {
            return null;
        }

        $args = $node->getArgs();
        if ($this->argsAnalyzer->hasNamedArg($args)) {
            return null;
        }

        if (! isset($args[0])) {
            return null;
        }

        $value = $args[0]->value;
        if (! $value instanceof Array_) {
            return null;
        }

        return $this->processExtractIsGranted($node, $value);
    }

    private function processExtractIsGranted(MethodCall $methodCall, Array_ $array): MethodCall|BooleanOr|null
    {
        $exprs = [];

        foreach ($array->items as $item) {
            if ($item instanceof ArrayItem) {
                $exprs[] = $item->value;
            }
        }

        if ($exprs === []) {
            return null;
        }

        $args = $methodCall->getArgs();
        $args[0]->value = $exprs[0];
        $methodCall->args = $args;

        if (count($exprs) === 1) {
            return $methodCall;
        }

        $newMethodCallLeft = new MethodCall($methodCall->var, $methodCall->name, $args, $methodCall->getAttributes());

        $rightMethodCall = clone $methodCall;
        $rightMethodCall->args[0] = new Arg($exprs[1]);
        $newMethodCallRight = new MethodCall(
            $methodCall->var,
            $methodCall->name,
            $rightMethodCall->args,
            $methodCall->getAttributes()
        );

        $booleanOr = new BooleanOr($newMethodCallLeft, $newMethodCallRight);

        foreach ($exprs as $key => $expr) {
            if ($key <= 1) {
                continue;
            }

            $rightMethodCall = clone $methodCall;
            $rightMethodCall->args[0] = new Arg($expr);
            $newMethodCallRight = new MethodCall(
                $methodCall->var,
                $methodCall->name,
                $rightMethodCall->args,
                $methodCall->getAttributes()
            );

            $booleanOr = new BooleanOr($booleanOr, $newMethodCallRight);
        }

        return $booleanOr;
    }
}
