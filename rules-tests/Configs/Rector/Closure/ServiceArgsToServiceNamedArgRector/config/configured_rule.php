<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector;

return static function (RectorConfig $rectorConfig): void {

    $rectorConfig->rule(ServiceArgsToServiceNamedArgRector::class);
};
