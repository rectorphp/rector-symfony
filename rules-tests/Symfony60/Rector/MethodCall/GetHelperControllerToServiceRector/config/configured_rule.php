<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony60\Rector\MethodCall\GetHelperControllerToServiceRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(GetHelperControllerToServiceRector::class);
};
