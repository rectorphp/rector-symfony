<?php

namespace Rector\Symfony\Tests\Rector\StaticPropertyFetch\KernelTestCaseContainerPropertyDeprecationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SomeTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $container = self::$container;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\StaticPropertyFetch\KernelTestCaseContainerPropertyDeprecationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SomeTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $container = self::getContainer();
    }
}

?>
