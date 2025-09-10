<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

use PhpParser\Node\Expr;
use PhpParser\Node\Scalar\String_;
use Rector\Exception\NotImplementedYetException;

final readonly class CommandOption
{
    public function __construct(
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

    public function getStringName(): string
    {
        if ($this->name instanceof String_) {
            return $this->name->value;
        }

        throw new NotImplementedYetException(sprintf('Add more options to "%s"', self::class));
    }
}
