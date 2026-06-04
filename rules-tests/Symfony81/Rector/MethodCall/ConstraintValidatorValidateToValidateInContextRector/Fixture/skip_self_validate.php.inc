<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\ConstraintValidatorValidateToValidateInContextRector\Fixture;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\NotNull;

final class RecursiveConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (\is_array($value)) {
            foreach ($value as $item) {
                $this->validate($item, $constraint);
            }

            return;
        }

        \assert($constraint instanceof NotNull);
    }
}
?>
