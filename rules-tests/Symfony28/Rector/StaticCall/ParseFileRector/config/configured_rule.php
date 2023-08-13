<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony28\Rector\StaticCall\ParseFileRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ParseFileRector::class);
};
