<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class SkipTestCase extends KernelTestCase
{
    public function goStatic()
    {
        $service = self::$container->get('some');
    }
}
