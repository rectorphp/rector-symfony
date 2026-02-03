<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony73\Rector\Class_\AuthorizationCheckerToAccessDecisionManagerInVoterRector;

return RectorConfig::configure()
    ->withRules([AuthorizationCheckerToAccessDecisionManagerInVoterRector::class]);
