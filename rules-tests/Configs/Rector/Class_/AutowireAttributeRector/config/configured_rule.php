<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Configs\Rector\Class_\AutowireAttributeRector;

return RectorConfig::configure()
    ->withConfiguredRule(AutowireAttributeRector::class, [
        AutowireAttributeRector::CONFIGS_DIRECTORY => __DIR__ . '/../Source/configs',
    ]);
