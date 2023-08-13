<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony44\Rector\ClassMethod\ConsoleExecuteReturnIntRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ConsoleExecuteReturnIntRector::class);
};
