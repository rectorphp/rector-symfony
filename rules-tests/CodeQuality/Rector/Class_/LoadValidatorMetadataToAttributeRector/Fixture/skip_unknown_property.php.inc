<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipUnknownProperty
{
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        // the property is defined in a parent class or via magic, there is nothing local to decorate
        $metadata->addPropertyConstraint('city', new Assert\NotBlank());
    }
}
