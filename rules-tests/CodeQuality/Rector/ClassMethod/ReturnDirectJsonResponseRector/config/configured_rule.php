<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\ReturnDirectJsonResponseRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ReturnDirectJsonResponseRector::class);
};
