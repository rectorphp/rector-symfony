<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\InvokableController;

final class ActiveClassElements
{
    /**
     * @param string[] $propertyNames
     */
    public function __construct(
        private readonly array $propertyNames
    ) {
    }

    public function hasPropertyName(string $propertyFetchName): bool
    {
        return in_array($propertyFetchName, $this->propertyNames, true);
    }
}
