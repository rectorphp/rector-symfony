<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony73\Rector\Class_\InvokableCommandRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(InvokableCommandRector::class);
};
