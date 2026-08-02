<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Source;

use Symfony\Component\Validator\Constraint;

/**
 * Custom constraint written before Symfony 5.2, without the #[Attribute] declaration
 */
final class NonAttributeConstraint extends Constraint
{
    public $message = 'This value is not valid.';
}
