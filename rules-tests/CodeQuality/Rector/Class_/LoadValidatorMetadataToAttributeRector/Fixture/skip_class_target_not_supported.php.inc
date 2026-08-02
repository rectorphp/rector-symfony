<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipClassTargetNotSupported
{
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        // NotBlank declares TARGET_PROPERTY | TARGET_METHOD, so it must not be moved to the class
        $metadata->addConstraint(new Assert\NotBlank());
    }
}
