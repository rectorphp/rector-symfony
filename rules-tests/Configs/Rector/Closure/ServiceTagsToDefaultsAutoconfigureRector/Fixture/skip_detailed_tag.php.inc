<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceTagsToDefaultsAutoconfigureRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
         ->autowire()
         ->autoconfigure();

    $services->set('someclass')
        ->tag('monolog.logger', [
            'channel' => 'some_channel',
        ]);
};
