<?php

use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SkipServiceWithoutConstructor;
use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SomeConfiguredService;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeConfiguredService::class)
        ->arg('timeout', '%timeout%')
        ->arg('key', '%env(APP_KEY)%');

    // should be skipped
    $services->set(SkipServiceWithoutConstructor::class)
        ->arg('timeout', '%timeout%')
        ->arg('key', '%env(APP_KEY)%');
};
