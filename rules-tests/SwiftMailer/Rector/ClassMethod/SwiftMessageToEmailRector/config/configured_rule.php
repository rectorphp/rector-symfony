<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(SwiftMessageToEmailRector::class);
};
