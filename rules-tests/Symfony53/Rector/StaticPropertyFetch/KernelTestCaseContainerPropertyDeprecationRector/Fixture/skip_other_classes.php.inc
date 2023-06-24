<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\StaticPropertyFetch\KernelTestCaseContainerPropertyDeprecationRector\Fixture;

use PHPUnit\Framework\TestCase;

class SomeTest extends TestCase
{
    protected function setUp(): void
    {
        $container = self::$container;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\StaticPropertyFetch\KernelTestCaseContainerPropertyDeprecationRector\Fixture;

use PHPUnit\Framework\TestCase;

class SomeTest extends TestCase
{
    protected function setUp(): void
    {
        $container = self::$container;
    }
}

?>
