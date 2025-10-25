<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Closure\RemoveConstructorAutowireServiceRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\RemoveConstructorAutowireServiceRector\Source\AnotherClassWithoutConstructor;
use Rector\Symfony\Tests\Configs\Rector\Closure\RemoveConstructorAutowireServiceRector\Source\DifferentType;
use Rector\Symfony\Tests\Configs\Rector\Closure\RemoveConstructorAutowireServiceRector\Source\PassedAsDependency;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()->autowire();

    $services->set(AnotherClassWithoutConstructor::class)
        ->arg('$passedAsDependency', service(DifferentType::class));
};
