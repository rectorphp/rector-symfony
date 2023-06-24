<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony34\Rector\ClassMethod\RemoveServiceFromSensioRouteRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([RemoveServiceFromSensioRouteRector::class]);
};
