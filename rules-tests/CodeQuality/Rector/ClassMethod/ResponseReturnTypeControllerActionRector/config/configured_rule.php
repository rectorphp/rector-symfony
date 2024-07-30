<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector;

return RectorConfig::configure()
    ->withRules([ResponseReturnTypeControllerActionRector::class]);
