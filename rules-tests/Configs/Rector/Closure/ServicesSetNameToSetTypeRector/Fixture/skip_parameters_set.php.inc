<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServicesSetNameToSetTypeRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set('some_name', 'another_value');
};
