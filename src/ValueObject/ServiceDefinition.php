<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use Rector\Symfony\Contract\Tag\TagInterface;

final class ServiceDefinition
{
    /**
     * @param TagInterface[] $tags
     */
    public function __construct(
        private readonly string $id,
        private readonly ?string $class,
        private readonly bool $isPublic,
        private readonly bool $isSynthetic,
        private readonly ?string $alias,
        private readonly array $tags
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    public function isSynthetic(): bool
    {
        return $this->isSynthetic;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @return TagInterface[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function getTag(string $name): ?TagInterface
    {
        foreach ($this->tags as $tag) {
            if ($tag->getName() !== $name) {
                continue;
            }

            return $tag;
        }

        return null;
    }
}
