<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class WithCodeArg extends \Symfony\Component\Validator\ConstraintValidator
{
    public function validate($protocol, \Symfony\Component\Validator\Constraint $constraint)
    {
        $this->context->addViolationAt('property', 'The value {{ value }} is invalid.', array(
            '{{ value }}' => $invalidValue,
        ), $someInvalidValue, 1, $code);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class WithCodeArg extends \Symfony\Component\Validator\ConstraintValidator
{
    public function validate($protocol, \Symfony\Component\Validator\Constraint $constraint)
    {
        $this->context->buildViolation('The value {{ value }} is invalid.')->atPath('property')->setParameter('{{ value }}', $invalidValue)->setInvalidValue($someInvalidValue)->setPlural(1)->setCode($code)->addViolation();
    }
}

?>
