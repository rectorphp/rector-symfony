<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ContainerGetNameToTypeInTestsRector::class);

    $rectorConfig->symfonyContainerXml(__DIR__ . '/../xml/services.xml');
};
