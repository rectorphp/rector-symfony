<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr\Array_;

final readonly class ExtensionKeyAndConfiguration
{
    public function __construct(
        private string $key,
        private Array_ $array,
    ) {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getArray(): Array_
    {
        return $this->array;
    }
}
