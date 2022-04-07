<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\InvokableController;

final class ActiveClassElements
{
    /**
     * @param string[] $propertyNames
     * @param string[] $constantNames
     */
    public function __construct(
        private readonly array $propertyNames,
        private readonly array $constantNames,
    ) {
    }

    public function hasPropertyName(string $propertyName): bool
    {
        return in_array($propertyName, $this->propertyNames, true);
    }

    public function hasConstantName(string $constantName): bool
    {
        return in_array($constantName, $this->constantNames, true);
    }
}
