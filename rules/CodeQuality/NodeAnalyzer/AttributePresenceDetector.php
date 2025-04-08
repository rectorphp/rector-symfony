<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\NodeAnalyzer;

use PHPStan\Reflection\ReflectionProvider;

final readonly class AttributePresenceDetector
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
    ) {
    }

    public function detect(string $attributeClass): bool
    {
        // run only if the sensio attribute is available
        if (! $this->reflectionProvider->hasClass($attributeClass)) {
            return false;
        }

        // must be attribute, not just annotation
        $securityClassReflection = $this->reflectionProvider->getClass($attributeClass);

        return $securityClassReflection->isAttributeClass();
    }
}
