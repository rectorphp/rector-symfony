<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\ConstraintValidatorValidateToValidateInContextRector\Fixture;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

final class SomeValidatorTest extends ConstraintValidatorTestCase
{
    public function testValidate(): void
    {
        $this->validator->validate('value', new NotNull());
    }
}
?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\ConstraintValidatorValidateToValidateInContextRector\Fixture;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

final class SomeValidatorTest extends ConstraintValidatorTestCase
{
    public function testValidate(): void
    {
        $this->validate('value', new NotNull());
    }
}
?>
