<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr;

final readonly class ReplaceServiceArgument
{
    public function __construct(
        private mixed $oldValue,
        private Expr $newValueExpr
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
