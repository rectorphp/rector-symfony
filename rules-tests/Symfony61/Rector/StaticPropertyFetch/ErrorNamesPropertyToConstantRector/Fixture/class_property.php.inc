<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\StaticPropertyFetch\ErrorNamesPropertyToConstantRector\Fixture;

use Symfony\Component\Validator\Constraints\NotBlank;

final class ClassProperty extends NotBlank
{
    /**
     * @var string[]
     */
    protected static $errorNames = [];
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\StaticPropertyFetch\ErrorNamesPropertyToConstantRector\Fixture;

use Symfony\Component\Validator\Constraints\NotBlank;

final class ClassProperty extends NotBlank
{
    /**
     * @var string[]
     */
    protected const ERROR_NAMES = [];
}

?>
