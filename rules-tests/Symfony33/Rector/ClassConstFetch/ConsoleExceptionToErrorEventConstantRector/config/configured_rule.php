<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony33\Rector\ClassConstFetch\ConsoleExceptionToErrorEventConstantRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ConsoleExceptionToErrorEventConstantRector::class);
};
