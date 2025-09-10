<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

use PhpParser\Node\Expr;

final readonly class CommandArgument
{
    public function __construct(
        private string $nameValue,
        private Expr $name,
        private ?Expr $mode,
        private ?Expr $description,
        private ?Expr $default,
        private bool $isArray
    ) {
    }

    public function getNameValue(): string
    {
        return $this->nameValue;
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

    public function getDefault(): ?Expr
    {
        return $this->default;
    }

    public function isArray(): bool
    {
        return $this->isArray;
    }
}
