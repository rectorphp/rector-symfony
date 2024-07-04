<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\ValueObject;

final readonly class ServiceArguments
{
    /**
     * @param array<string|int, string> $params
     * @param array<string|int, string> $envs
     */
    public function __construct(
        private string $className,
        private array $params,
        private array $envs
    ) {
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return array<string|int, string>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return array<string|int, string>
     */
    public function getEnvs(): array
    {
        return $this->envs;
    }
}
