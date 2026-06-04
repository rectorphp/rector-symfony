<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\ConstraintValidatorValidateToValidateInContextRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SomeKernelTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    public function testValidate(): void
    {
        $this->validator->validate(new \stdClass(), null);
    }
}
?>
