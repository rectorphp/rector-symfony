<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class WithInvalidValueArg extends \Symfony\Component\Validator\ConstraintValidator
{
    public function validate($protocol, \Symfony\Component\Validator\Constraint $constraint)
    {
        $this->context->addViolationAt('property', 'The value {{ value }} is invalid.', array(
            '{{ value }}' => $invalidValue,
        ), $someInvalidValue);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class WithInvalidValueArg extends \Symfony\Component\Validator\ConstraintValidator
{
    public function validate($protocol, \Symfony\Component\Validator\Constraint $constraint)
    {
        $this->context->buildViolation('The value {{ value }} is invalid.')->atPath('property')->setParameter('{{ value }}', $invalidValue)->setInvalidValue($someInvalidValue)->addViolation();
    }
}

?>
