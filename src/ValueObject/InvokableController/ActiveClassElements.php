<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\InvokableController;

use PhpParser\Node\Stmt\Property;

final class ActiveClassElements
{
    /**
     * @param string[] $propertyNames
     */
    public function __construct(
        private array $propertyNames
    ) {
    }

    public function hasProperty(Property $property): bool
    {
        $onlyProperty = $property->props[0];
        $propertyName = $onlyProperty->name->toString();

        return in_array($propertyName, $this->propertyNames, true);
    }
}
