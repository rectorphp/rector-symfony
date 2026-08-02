<?php

namespace Rector\Symfony\Tests\ComposerBased\Fixture;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class VersionBoundViolationBuilder extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $this->context->addViolationAt('property', 'The value {{ value }} is invalid.', [
            '{{ value }}' => $value,
        ]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\ComposerBased\Fixture;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class VersionBoundViolationBuilder extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $this->context->buildViolation('The value {{ value }} is invalid.')->atPath('property')->setParameter('{{ value }}', $value)->addViolation();
    }
}

?>
