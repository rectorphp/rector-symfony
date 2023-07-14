<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServicesSetNameToSetTypeRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServicesSetNameToSetTypeRector\Source\SpecificClass;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('some_name', SpecificClass::class);

    $services->set('another_name', SpecificClass::class);
};
