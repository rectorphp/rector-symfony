<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SkipAnotherGet extends Controller
{
    public function configure()
    {
        $someType = $this->some->get(SomeService::class);
    }
}
