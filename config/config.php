<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->load('Rector\\Symfony\\', __DIR__ . '/../src')
        ->exclude([__DIR__ . '/../src/Rector', __DIR__ . '/../src/ValueObject']);
};
