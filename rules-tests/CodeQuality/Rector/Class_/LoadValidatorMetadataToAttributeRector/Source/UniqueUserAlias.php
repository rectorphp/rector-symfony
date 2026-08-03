<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Source;

use Attribute;
use Symfony\Component\Validator\Constraint;

/**
 * Custom constraint that configures itself through properties, without a constructor of its own
 */
#[Attribute]
final class UniqueUserAlias extends Constraint
{
    public $message = 'This alias is already in use.';

    public $field = '';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getDefaultOption(): string
    {
        return 'field';
    }
}
