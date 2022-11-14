<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Rector\Class_\ChangeFileLoaderInExtensionAndKernelRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->ruleWithConfiguration(ChangeFileLoaderInExtensionAndKernelRector::class, [
        ChangeFileLoaderInExtensionAndKernelRector::FROM => 'xml',
        ChangeFileLoaderInExtensionAndKernelRector::TO => 'yaml',
    ]);
};
