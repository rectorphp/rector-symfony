<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(\Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SomeConfiguredService::class)
        ->arg('timeout', '%timeout%')
        ->arg('key', '%env(APP_KEY)%');

    $services->set(\Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SkipServiceWithoutConstructor::class)
        ->arg('timeout', '%timeout%')
        ->arg('key', '%env(APP_KEY)%');
};
