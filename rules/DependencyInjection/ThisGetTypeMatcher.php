<?php

declare(strict_types=1);

namespace Rector\Symfony\DependencyInjection;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use Rector\NodeNameResolver\NodeNameResolver;

final readonly class ThisGetTypeMatcher
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver
    ) {
    }

    public function matchString(MethodCall $methodCall): ?string
    {
        $getExpr = $this->matchGetExpr($methodCall);
        if (! $getExpr instanceof String_) {
            return null;
        }

        return $getExpr->value;
    }

    public function match(MethodCall $methodCall): ?string
    {
        $getExpr = $this->matchGetExpr($methodCall);
        if (! $getExpr instanceof ClassConstFetch) {
            return null;
        }

        // must be class const fetch
        if (! $this->nodeNameResolver->isName($getExpr->name, 'class')) {
            return null;
        }

        return $this->nodeNameResolver->getName($getExpr->class);
    }

    private function isValidContainerCall(MethodCall $methodCall): bool
    {
        if ($methodCall->var instanceof MethodCall && $this->nodeNameResolver->isName(
            $methodCall->var->name,
            'getContainer'
        )) {
            return true;
        }

        if ($methodCall->var instanceof Variable && $this->nodeNameResolver->isName($methodCall->var, 'this')) {
            return true;
        }

        if ($methodCall->var instanceof PropertyFetch && $this->nodeNameResolver->isName(
            $methodCall->var->var,
            'this'
        ) && $this->nodeNameResolver->isName($methodCall->var->name, 'container')) {
            return true;
        }

        return false;
    }

    private function matchGetExpr(MethodCall $methodCall): ?\PhpParser\Node\Expr
    {
        if ($methodCall->isFirstClassCallable()) {
            return null;
        }

        if (! $this->nodeNameResolver->isName($methodCall->name, 'get')) {
            return null;
        }

        if (! $this->isValidContainerCall($methodCall)) {
            return null;
        }

        if (count($methodCall->getArgs()) !== 1) {
            return null;
        }

        $firstArg = $methodCall->getArgs()[0];
        return $firstArg->value;
    }
}
