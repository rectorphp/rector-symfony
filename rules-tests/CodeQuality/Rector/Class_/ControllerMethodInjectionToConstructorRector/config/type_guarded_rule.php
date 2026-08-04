<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\AbstractCustomController;

return RectorConfig::configure()
    ->withRules([ControllerMethodInjectionToConstructorRector::class])
    ->withTypeGuardedClasses([AbstractCustomController::class]);
