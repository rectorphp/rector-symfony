<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Rector\BinaryOp\ResponseStatusCodeRector;
use Rector\Symfony\Rector\Class_\EventListenerToEventSubscriberRector;
use Rector\Symfony\Rector\Class_\MakeCommandLazyRector;
use Rector\Symfony\Rector\ClassMethod\ResponseReturnTypeControllerActionRector;
use Rector\Symfony\Rector\MethodCall\LiteralGetToRequestClassConstantRector;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();
    $services->set(MakeCommandLazyRector::class);
    $services->set(EventListenerToEventSubscriberRector::class);
    $services->set(ResponseReturnTypeControllerActionRector::class);

    // int and string literals to const fetches
    $services->set(ResponseStatusCodeRector::class);
    $services->set(LiteralGetToRequestClassConstantRector::class);
};
