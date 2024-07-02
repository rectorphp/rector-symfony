<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\ValueObject;

final readonly class ServiceArguments
{
    /**
     * @param array<string, string> $params
     * @param array<string, string> $envs
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
     * @return array<string, string>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return array<string, string>
     */
    public function getEnvs(): array
    {
        return $this->envs;
    }
}
