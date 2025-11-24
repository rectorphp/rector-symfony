<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

final class SomeClass
{
    public function __construct()
    {
        new UniqueEntity(['fields' => 'email', 'message' => 'Duplicate email.']);
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

final class SomeClass
{
    public function __construct()
    {
        new UniqueEntity(fields: 'email', message: 'Duplicate email.');
    }
}
?>
