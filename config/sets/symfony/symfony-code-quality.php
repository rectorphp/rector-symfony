<?php

declare(strict_types=1);

use Rector\Symfony\Rector\BinaryOp\ResponseStatusCodeRector;
use Rector\Symfony\Rector\Class_\EventListenerToEventSubscriberRector;
use Rector\Symfony\Rector\Class_\MakeCommandLazyRector;
use Rector\Symfony\Rector\ClassMethod\ResponseReturnTypeControllerActionRector;
use Rector\Symfony\Rector\MethodCall\LiteralGetToRequestClassConstantRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->set(MakeCommandLazyRector::class);
    $services->set(EventListenerToEventSubscriberRector::class);
    $services->set(ResponseReturnTypeControllerActionRector::class);

    // int and string literals to const fetches
    $services->set(ResponseStatusCodeRector::class);
    $services->set(LiteralGetToRequestClassConstantRector::class);
};
