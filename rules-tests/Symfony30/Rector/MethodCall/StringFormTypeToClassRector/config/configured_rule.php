<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony30\Rector\MethodCall\StringFormTypeToClassRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(StringFormTypeToClassRector::class);
};
