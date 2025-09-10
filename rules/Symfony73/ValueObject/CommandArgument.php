<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

use PhpParser\Node\Expr;

final readonly class CommandArgument
{
    public function __construct(
        private Expr $name,
        private ?Expr $mode,
        private ?Expr $description
    ) {
    }

    public function getName(): Expr
    {
        return $this->name;
    }

    public function getMode(): ?Expr
    {
        return $this->mode;
    }

    public function getDescription(): ?Expr
    {
        return $this->description;
    }
}
