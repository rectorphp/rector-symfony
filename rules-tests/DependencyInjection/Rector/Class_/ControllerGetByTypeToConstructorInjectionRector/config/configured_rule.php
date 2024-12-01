<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(
        \Rector\Symfony\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector::class
    );
};
