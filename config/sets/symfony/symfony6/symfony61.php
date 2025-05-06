<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony61\Rector\Class_\CommandConfigureToAttributeRector;
use Rector\Symfony\Symfony61\Rector\Class_\CommandPropertyToAttributeRector;
use Rector\Symfony\Symfony61\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector;

# https://github.com/symfony/symfony/blob/6.1/UPGRADE-6.1.md

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        CommandConfigureToAttributeRector::class,
        CommandPropertyToAttributeRector::class,
        MagicClosureTwigExtensionToNativeMethodsRector::class,
    ]);

    $rectorConfig->import(__DIR__ . '/symfony61/symfony61-serializer.php');
    $rectorConfig->import(__DIR__ . '/symfony61/symfony61-validator.php');
};
