<?php

declare(strict_types=1);

use Rector\Symfony\Rector\Class_\ChangeFileLoaderInExtensionAndKernelRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();

    $services->set(ChangeFileLoaderInExtensionAndKernelRector::class)
        ->configure([
            ChangeFileLoaderInExtensionAndKernelRector::FROM => 'xml',
            ChangeFileLoaderInExtensionAndKernelRector::TO => 'yaml',
        ]);
};
