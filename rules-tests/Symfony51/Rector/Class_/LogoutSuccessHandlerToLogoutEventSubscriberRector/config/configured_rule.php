<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony51\Rector\Class_\LogoutSuccessHandlerToLogoutEventSubscriberRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../../config/config.php');
    $rectorConfig->rule(LogoutSuccessHandlerToLogoutEventSubscriberRector::class);
};
