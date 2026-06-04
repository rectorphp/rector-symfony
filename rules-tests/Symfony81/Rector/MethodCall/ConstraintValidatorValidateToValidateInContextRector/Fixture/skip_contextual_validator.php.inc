<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\ConstraintValidatorValidateToValidateInContextRector\Fixture;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\NotNull;

final class SomeConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        $validator = $this->context->getValidator()->inContext($this->context);
        $validator->validate($value, $constraint);
    }
}
?>
