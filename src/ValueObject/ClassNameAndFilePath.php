<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

final readonly class ClassNameAndFilePath
{
    public function __construct(
        private string $className,
        private string $filePath,
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
