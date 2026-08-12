<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony61\Rector\Attribute\RouteRequirementStringToConstantRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RouteRequirementStringToConstantRector::class);
};
