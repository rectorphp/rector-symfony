<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints\NotBlank;

class GroupsScalarToArray
{
    public function run()
    {
        return new NotBlank(['groups' => 'indexableFieldWithLimits']);
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints\NotBlank;

class GroupsScalarToArray
{
    public function run()
    {
        return new NotBlank(groups: ['indexableFieldWithLimits']);
    }
}
?>
