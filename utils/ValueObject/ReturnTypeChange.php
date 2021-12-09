<?php

declare(strict_types=1);

namespace Rector\Symfony\Utils\ValueObject;

final class ReturnTypeChange
{
    public function __construct(
        private readonly string $class,
        private readonly string $method,
        private readonly string $returnType
    ) {
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getReturnType(): string
    {
        return $this->returnType;
    }
}
