<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Rector\MethodCall\StringFormTypeToClassRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->symfonyContainerXml(__DIR__ . '/../Source/custom_container.xml');
    $rectorConfig->rule(StringFormTypeToClassRector::class);
};
