<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Closure\StringExtensionToConfigBuilderRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(StringExtensionToConfigBuilderRector::class);
};
