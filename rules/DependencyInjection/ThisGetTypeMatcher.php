<?php

declare(strict_types=1);

namespace Rector\Symfony\DependencyInjection;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use Rector\NodeNameResolver\NodeNameResolver;

final readonly class ThisGetTypeMatcher
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver
    ) {
    }

    public function match(MethodCall $methodCall): ?string
    {
        if ($methodCall->isFirstClassCallable()) {
            return null;
        }

        if (! $this->nodeNameResolver->isName($methodCall->name, 'get')) {
            return null;
        }

        if (! $this->nodeNameResolver->isName($methodCall->var, 'this')) {
            return null;
        }

        if (count($methodCall->getArgs()) !== 1) {
            return null;
        }

        $firstArg = $methodCall->getArgs()[0];
        if (! $firstArg->value instanceof ClassConstFetch) {
            return null;
        }

        // must be class const fetch
        if (! $this->nodeNameResolver->isName($firstArg->value->name, 'class')) {
            return null;
        }

        return $this->nodeNameResolver->getName($firstArg->value->class);
    }
}
