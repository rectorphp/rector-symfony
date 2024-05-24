<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\SwiftMailer\Rector\ClassMethod\Swift_MessageToEmailRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(Swift_MessageToEmailRector::class);
};
