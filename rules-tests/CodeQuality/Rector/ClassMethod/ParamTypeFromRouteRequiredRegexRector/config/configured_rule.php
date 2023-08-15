<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\ParamTypeFromRouteRequiredRegexRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ParamTypeFromRouteRequiredRegexRector::class);
};
