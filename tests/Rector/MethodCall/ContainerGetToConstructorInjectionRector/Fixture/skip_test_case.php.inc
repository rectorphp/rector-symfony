<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class SkipTestCase extends KernelTestCase
{
    public function goStatic()
    {
        $service = self::$container->get('some');
    }

    public function goMethod()
    {
        $service = static::getContainer()->get('some');
    }
}
