<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->symfonyContainerXml(__DIR__ . '/../xml/services.xml');
    $rectorConfig->rule(ContainerGetToConstructorInjectionRector::class);
};
