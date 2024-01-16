<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\Expression;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\ValueObject\ExtensionKeyAndConfiguration;

final readonly class SymfonyClosureExtensionMatcher
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private ValueResolver $valueResolver,
    ) {
    }

    public function match(Closure $closure): ?ExtensionKeyAndConfiguration
    {
        // must be exactly single line
        if (count($closure->stmts) !== 1) {
            return null;
        }

        $onlyStmt = $closure->stmts[0];
        if (! $onlyStmt instanceof Expression) {
            return null;
        }

        if (! $onlyStmt->expr instanceof MethodCall) {
            return null;
        }

        $methodCall = $onlyStmt->expr;
        if (! $this->nodeNameResolver->isName($methodCall->name, 'extension')) {
            return null;
        }

        $args = $methodCall->getArgs();

        $firstArg = $args[0];
        $extensionKey = $this->valueResolver->getValue($firstArg->value);

        $secondArg = $args[1];
        if (! $secondArg->value instanceof Array_) {
            return null;
        }

        return new ExtensionKeyAndConfiguration($extensionKey, $secondArg->value);
    }
}
