<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\BinaryOp\RequestIsMainRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RequestIsMainRector::class);
};
