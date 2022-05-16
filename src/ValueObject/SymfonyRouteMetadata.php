<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

class SymfonyRouteMetadata
{
    /**
     * @param mixed[]  $defaults
     * @param string[]  $requirements
     * @param string[]  $schemes
     * @param string[]  $methods
     */
    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly array $defaults = [],
        private readonly array $requirements = [],
        private readonly string $host = '',
        private readonly array $schemes = [],
        private readonly array $methods = [],
        private readonly string $condition = ''
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
     * @return mixed[]
     */
    public function getDefaults(): array
    {
        return $this->defaults;
    }

    public function getDefault(string $name): mixed
    {
        return $this->defaults[$name] ?? null;
    }

    /**
     * @return string[]
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
