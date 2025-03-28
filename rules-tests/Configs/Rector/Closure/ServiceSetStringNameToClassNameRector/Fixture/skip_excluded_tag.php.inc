<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSetStringNameToClassNameRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSetStringNameToClassNameRector\Source\ExcludedService;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('excluded', ExcludedService::class);
};
