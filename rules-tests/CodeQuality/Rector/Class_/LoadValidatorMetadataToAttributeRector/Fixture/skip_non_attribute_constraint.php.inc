<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Source\NonAttributeConstraint;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipNonAttributeConstraint
{
    private $city;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        // the constraint has no #[Attribute], the validator would crash on load
        $metadata->addPropertyConstraint('city', new NonAttributeConstraint());
    }
}
