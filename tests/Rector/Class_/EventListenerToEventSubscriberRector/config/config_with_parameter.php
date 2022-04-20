<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Symfony\Rector\Class_\EventListenerToEventSubscriberRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');
    $parameters = $rectorConfig->parameters();
    // wtf: all test have to be in single file due to autoloading race-condigition and container creating issue of fixture
    $parameters->set(Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER, __DIR__ . '/listener_services.xml');
    $rectorConfig->rule(EventListenerToEventSubscriberRector::class);
};
