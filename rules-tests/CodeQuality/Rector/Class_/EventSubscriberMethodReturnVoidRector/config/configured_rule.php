<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector;

return RectorConfig::configure()
    ->withRules([EventSubscriberMethodReturnVoidRector::class]);
