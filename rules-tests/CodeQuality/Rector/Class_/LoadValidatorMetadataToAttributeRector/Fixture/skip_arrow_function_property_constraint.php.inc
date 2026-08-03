<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipArrowFunctionPropertyConstraint
{
    private $city;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('city', new Callback([
            'callback' => fn (): bool => true,
        ]));
    }
}
