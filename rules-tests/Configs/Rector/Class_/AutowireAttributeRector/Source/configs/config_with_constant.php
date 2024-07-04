<?php

use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture\WithConstant;
use Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Source\ParameterName;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(WithConstant::class)
        ->arg('$googleKey', '%' . ParameterName::GOOGLE_KEY . '%');
};
