<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony82\Rector\MethodCall\ScheduleWithToAddRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ScheduleWithToAddRector::class);
};
