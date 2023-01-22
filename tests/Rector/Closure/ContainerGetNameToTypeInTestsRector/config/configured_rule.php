<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->rule(\Rector\Symfony\Rector\Closure\ContainerGetNameToTypeInTestsRector::class);

    $rectorConfig->symfonyContainerXml(__DIR__ . '/../xml/services.xml');
};
