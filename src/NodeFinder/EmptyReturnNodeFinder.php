<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFinder;

use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use Rector\Core\PhpParser\Node\BetterNodeFinder;

final class EmptyReturnNodeFinder
{
    public function __construct(
        private readonly BetterNodeFinder $betterNodeFinder
    ) {
    }

    public function hasNoOrEmptyReturns(ClassMethod $classMethod): bool
    {
        /** @var Return_[] $returns */
        $returns = $this->betterNodeFinder->findInstanceOf($classMethod, Return_::class);

        if ($returns === []) {
            return true;
        }

        foreach ($returns as $return) {
            if ($return->expr instanceof Expr) {
                continue;
            }

            return true;
        }

        return false;
    }
}
