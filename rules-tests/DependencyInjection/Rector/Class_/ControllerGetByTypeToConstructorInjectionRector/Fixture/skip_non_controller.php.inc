<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService;

final class SkipNonController
{
    public function configure()
    {
        $someType = $this->get(SomeService::class);
    }
}
