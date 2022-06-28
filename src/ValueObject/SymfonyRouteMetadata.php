<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

class SymfonyRouteMetadata
{
    /**
     * Format <class>::<method>
     */
    private readonly ?string $controllerReference;

    /**
     * @param array<string, mixed> $defaults
     * @param array<string, mixed> $requirements
     * @param string[] $schemes
     * @param string[] $methods
     * @param array<string, mixed> $options
     */
    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly array $defaults,
        private readonly array $requirements,
        private readonly string $host,
        private readonly array $schemes,
        private readonly array $methods,
        private readonly string $condition,
        private readonly array $options,
    ) {
        $this->controllerReference = $defaults['_controller'] ?? null;
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

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptionsWithoutDefaultCompilerClass(): array
    {
        $options = $this->options;

        $compilerClass = $options['compiler_class'] ?? null;
        if ($compilerClass === 'Symfony\Component\Routing\RouteCompiler') {
            unset($options['compiler_class']);
        }

        return $options;
    }

    /**
     * Format <class>::<method>
     */
    public function getControllerReference(): ?string
    {
        return $this->controllerReference;
    }
}
