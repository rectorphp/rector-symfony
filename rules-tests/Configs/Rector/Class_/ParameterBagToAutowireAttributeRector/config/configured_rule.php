<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Configs\Rector\Class_\ParameterBagToAutowireAttributeRector;

return RectorConfig::configure()
    ->withRules([ParameterBagToAutowireAttributeRector::class]);
