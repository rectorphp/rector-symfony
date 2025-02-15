<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(InlineClassRoutePrefixRector::class);
};
