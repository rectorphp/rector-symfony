<?php

namespace Rector\Symfony\Tests\ComposerBased\Fixture;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

// AddViolationToBuildViolationRector is capped at symfony/validator <5.0, so it stays inactive on the installed version
final class SkipVersionBoundViolationBuilder extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $this->context->addViolationAt('property', 'The value {{ value }} is invalid.', [
            '{{ value }}' => $value,
        ]);
    }
}
