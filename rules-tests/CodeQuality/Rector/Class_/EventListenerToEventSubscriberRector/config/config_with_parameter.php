<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector;

return static function (RectorConfig $rectorConfig): void {
    // wtf: all test have to be in single file due to autoloading race condition and container creating issue of fixture
    $rectorConfig->symfonyContainerXml(__DIR__ . '/listener_services.xml');
    $rectorConfig->rule(EventListenerToEventSubscriberRector::class);
};
