<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

return RectorConfig::configure()
    ->withRules([ResponseReturnTypeControllerActionRector::class])
    ->withTypeGuardedClasses([AbstractController::class]);
