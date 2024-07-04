<?php

use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\AnotherConfiguredService;
use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SkipServiceWithoutConstructor;
use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\SomeConfiguredService;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeConfiguredService::class)
        ->arg('timeout', '%timeout%')
        ->arg('key', '%env(APP_KEY)%');

    $services->set(AnotherConfiguredService::class)
        ->arg('missing', '%MISSING_PARAM%')
        ->arg('someParameter', '%SOME_PARAM%');

    // should be skipped
    $services->set(SkipServiceWithoutConstructor::class)
        ->arg('timeout', '%timeout%')
        ->arg('key', '%env(APP_KEY)%');
};
