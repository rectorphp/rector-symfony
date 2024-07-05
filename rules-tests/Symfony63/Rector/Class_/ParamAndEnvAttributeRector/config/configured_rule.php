<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony63\Rector\Class_\ParamAndEnvAttributeRector;

return RectorConfig::configure()
    ->withRules([ParamAndEnvAttributeRector::class]);
