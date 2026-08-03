<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Source\UniqueUserAlias;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipConstraintWithoutOwnConstructor
{
    private $alias;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addConstraint(new UniqueUserAlias([
            'field'   => 'alias',
            'message' => 'mautic.lead.list.alias.unique',
        ]));
    }
}
