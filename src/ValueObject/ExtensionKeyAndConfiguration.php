<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr\Array_;

final class ExtensionKeyAndConfiguration
{
    public function __construct(
        private readonly string $key,
        private readonly Array_ $array,
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
