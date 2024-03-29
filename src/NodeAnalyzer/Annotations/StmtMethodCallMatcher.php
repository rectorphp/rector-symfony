<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\Annotations;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Expression;
use Rector\NodeNameResolver\NodeNameResolver;

final readonly class StmtMethodCallMatcher
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver
    ) {
    }

    public function match(Stmt $stmt, string $methodName): ?MethodCall
    {
        if (! $stmt instanceof Expression) {
            return null;
        }

        if (! $stmt->expr instanceof MethodCall) {
            return null;
        }

        $methodCall = $stmt->expr;
        if (! $this->nodeNameResolver->isName($methodCall->name, $methodName)) {
            return null;
        }

        return $methodCall;
    }
}
