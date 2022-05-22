<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

class SymfonyRouteMetadata
{
    /**
     * @param array<string, mixed> $defaults
     * @param array<string, mixed> $requirements
     * @param string[] $schemes
     * @param string[] $methods
     */
    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly array $defaults,
        private readonly array $requirements,
        private readonly string $host,
        private readonly array $schemes,
        private readonly array $methods,
        private readonly string $condition
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array<string, mixed>
     */
    public function getDefaults(): array
    {
        return $this->defaults;
    }

    /**
     * @return array<string, mixed>
     */
    public function getDefaultsWithoutController(): array
    {
        $defaults = $this->defaults;
        unset($defaults['_controller']);

        return $defaults;
    }

    public function getDefault(string $name): mixed
    {
        return $this->defaults[$name] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    public function getRequirements(): array
    {
        return $this->requirements;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string[]
     */
    public function getSchemes(): array
    {
        return $this->schemes;
    }

    /**
     * @return string[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }
}
