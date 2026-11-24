<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints\Count;

new Count(['min' => 1, 'message' => 'This field cannot be blank'], groups: ['my_validation_group']);

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints\Count;

new Count(min: 1, message: 'This field cannot be blank', groups: ['my_validation_group']);

?>
