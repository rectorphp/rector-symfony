<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

final readonly class CommandArgument
{
    public function __construct(
        private string $name
        // @todo type
        // @todo default value
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
