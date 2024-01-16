<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

final readonly class SymfonyRouteMetadata
{
    /**
     * Format <class>::<method>
     */
    private ?string $controllerReference;

    /**
     * @param array<string, mixed> $defaults
     * @param array<string, mixed> $requirements
     * @param string[] $schemes
     * @param string[] $methods
     * @param array<string, mixed> $options
     */
    public function __construct(
        private string $name,
        private string $path,
        private array $defaults,
        private array $requirements,
        private string $host,
        private array $schemes,
        private array $methods,
        private string $condition,
        private array $options,
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
    public function getDefaultsWithoutController(): array
    {
        $defaults = $this->defaults;
        unset($defaults['_controller']);

        return $defaults;
    }

    /**
     * @api used
     */
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
