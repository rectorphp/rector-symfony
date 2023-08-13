<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony43\Rector\MethodCall\MakeDispatchFirstArgumentEventRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(MakeDispatchFirstArgumentEventRector::class);
};
