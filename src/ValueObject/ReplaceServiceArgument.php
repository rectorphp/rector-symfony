<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr;

final class ReplaceServiceArgument
{
    public function __construct(
        private readonly mixed $oldValue,
        private readonly Expr $newValueExpr
    ) {
    }

    public function getOldValue(): mixed
    {
        return $this->oldValue;
    }

    public function getNewValueExpr(): Expr
    {
        return $this->newValueExpr;
    }
}
