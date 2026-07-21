<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector;
use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source\AbstractCustomController;

return RectorConfig::configure()
    ->withRules([ResponseReturnTypeControllerActionRector::class])
    ->withTypeGuardedClasses([AbstractCustomController::class]);
