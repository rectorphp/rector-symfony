<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony25\Rector\MethodCall\AddViolationToBuildViolationRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(AddViolationToBuildViolationRector::class);
};
