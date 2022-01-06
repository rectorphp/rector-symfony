<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use Rector\Symfony\Contract\Tag\TagInterface;

final class Tag implements TagInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(
        private readonly string $name,
        private readonly array $data = []
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }
}
