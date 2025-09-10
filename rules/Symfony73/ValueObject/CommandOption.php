<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

use PhpParser\Node\Expr;

final readonly class CommandOption
{
    public function __construct(
        private string $nameValue,
        private Expr $name,
        private ?Expr $shortcut,
        private ?Expr $mode,
        private ?Expr $description,
    ) {
    }

    public function getName(): Expr
    {
        return $this->name;
    }

    public function getShortcut(): ?Expr
    {
        return $this->shortcut;
    }

    public function getMode(): ?Expr
    {
        return $this->mode;
    }

    public function getDescription(): ?Expr
    {
        return $this->description;
    }

    public function getNameValue(): string
    {
        return $this->nameValue;
    }
}
