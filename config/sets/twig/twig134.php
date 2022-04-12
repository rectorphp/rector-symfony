<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Symfony\Rector\Return_\SimpleFunctionAndFilterRector;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    $services->set(SimpleFunctionAndFilterRector::class);
};
