<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ControllerGetByTypeToConstructorInjectionRector::class);
};
