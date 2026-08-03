<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Source\TypeList;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipMethodCallConstraintOption
{
    private $type;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('type', new Choice(choices: (new TypeList())->getChoices()));
    }
}
