<?php

declare(strict_types=1);

use Rector\Symfony\Rector\MethodCall\ContainerGetToConstructorInjectionRector;
use Rector\Symfony\Rector\MethodCall\GetParameterToConstructorInjectionRector;
use Rector\Symfony\Rector\MethodCall\GetToConstructorInjectionRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(ContainerGetToConstructorInjectionRector::class);
    $services->set(GetParameterToConstructorInjectionRector::class);
    $services->set(GetToConstructorInjectionRector::class);
};
