<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\ConstraintValidatorValidateToValidateInContextRector\Fixture;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

final class AlreadyMigratedValidatorTest extends ConstraintValidatorTestCase
{
    public function testValidate(): void
    {
        $this->validator->validateInContext('value', new NotNull(), $this->context);
    }
}
?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\ConstraintValidatorValidateToValidateInContextRector\Fixture;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

final class AlreadyMigratedValidatorTest extends ConstraintValidatorTestCase
{
    public function testValidate(): void
    {
        $this->validate('value', new NotNull());
    }
}
?>
