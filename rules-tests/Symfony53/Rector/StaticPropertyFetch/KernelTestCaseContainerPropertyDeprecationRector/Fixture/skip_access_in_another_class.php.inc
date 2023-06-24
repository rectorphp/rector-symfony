<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\StaticPropertyFetch\KernelTestCaseContainerPropertyDeprecationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SomeTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $container = \Foo::$container;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\StaticPropertyFetch\KernelTestCaseContainerPropertyDeprecationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SomeTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $container = \Foo::$container;
    }
}

?>
