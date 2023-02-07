<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

class ClassNameAndFilePath
{
    public function __construct(
        private readonly string $className,
        private readonly string $filePath,
    ) {
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
