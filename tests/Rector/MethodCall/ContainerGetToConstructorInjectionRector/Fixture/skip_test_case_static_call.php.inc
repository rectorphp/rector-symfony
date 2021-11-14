<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class SkipTestCaseStaticCall extends KernelTestCase
{
    public function goMethod()
    {
        $service = static::getContainer()->get('some');
    }
}
