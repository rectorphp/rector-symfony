<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony28\Rector\MethodCall\GetToConstructorInjectionRector;
use Rector\Symfony\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ContainerGetToConstructorInjectionRector::class);
    $rectorConfig->rule(GetToConstructorInjectionRector::class);
};
