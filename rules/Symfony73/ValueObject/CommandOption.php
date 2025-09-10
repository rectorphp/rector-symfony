<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

use PhpParser\Node\Expr;
use PHPStan\Type\Type;

final readonly class CommandOption
{
    public function __construct(
        private string $nameValue,
        private Expr $name,
        private ?Expr $shortcut,
        private ?Expr $mode,
        private ?Expr $description,
        private ?Expr $default,
        private bool $isArray,
        private bool $isImplicitBoolean,
        private ?Type $defaultType
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

    public function getDefault(): ?Expr
    {
        return $this->default;
    }

    public function getDefaultType(): ?Type
    {
        return $this->defaultType;
    }

    public function isArray(): bool
    {
        return $this->isArray;
    }

    public function isImplicitBoolean(): bool
    {
        return $this->isImplicitBoolean;
    }
}
