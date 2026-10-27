<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(EventSubscriberToAttributeRector::class);
};
