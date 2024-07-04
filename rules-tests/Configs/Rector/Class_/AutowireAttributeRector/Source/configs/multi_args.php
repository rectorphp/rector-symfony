<?php

use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\AnotherConfiguredService;
use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SkipServiceWithoutConstructor;
use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SomeConfiguredService;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(\Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\MultiArgs::class)
        ->args([
            \Symfony\Component\DependencyInjection\Loader\Configurator\service('some_service'),
            '%timeout%'
        ]);
};
