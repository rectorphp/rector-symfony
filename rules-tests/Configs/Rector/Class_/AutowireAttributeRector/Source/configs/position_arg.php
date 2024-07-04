<?php

use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\PositionedArg;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(PositionedArg::class)
        ->arg(1, '%second_item%')
        ->arg(0, '%first_item%');
};
