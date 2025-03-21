<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

final class CommandOptionMetadata
{
    public function __construct(
        private readonly string $name,
        // @todo type
        // @todo default value
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
