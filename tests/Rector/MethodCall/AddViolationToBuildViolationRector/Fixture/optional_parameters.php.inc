<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class OptionalParameters extends \Symfony\Component\Validator\ConstraintValidator
{
    public function validate($protocol, \Symfony\Component\Validator\Constraint $constraint)
    {
        $this->context->addViolationAt('property', 'The value {{ value }} is invalid.');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddViolationToBuildViolationRector\Fixture;

class OptionalParameters extends \Symfony\Component\Validator\ConstraintValidator
{
    public function validate($protocol, \Symfony\Component\Validator\Constraint $constraint)
    {
        $this->context->buildViolation('The value {{ value }} is invalid.')->atPath('property')->addViolation();
    }
}

?>
