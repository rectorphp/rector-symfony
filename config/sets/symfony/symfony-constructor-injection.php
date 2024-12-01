<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\DependencyInjection\Rector\Class_\CommandGetByTypeToConstructorInjectionRector;
use Rector\Symfony\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector;
use Rector\Symfony\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector;
use Rector\Symfony\Symfony28\Rector\MethodCall\GetToConstructorInjectionRector;
use Rector\Symfony\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector;
use Rector\Symfony\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        // modern step-by-step narrow approach
        ControllerGetByTypeToConstructorInjectionRector::class,
        CommandGetByTypeToConstructorInjectionRector::class,
        TraitGetByTypeToInjectRector::class,

        // legacy rules that require container fetch
        ContainerGetToConstructorInjectionRector::class,
        ContainerGetNameToTypeInTestsRector::class,
        GetToConstructorInjectionRector::class,
    ]);
};
