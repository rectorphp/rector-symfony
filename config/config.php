<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Core\NonPhpFile\Rector\RenameClassNonPhpRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SmartFileSystem\SmartFileSystem;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER, null);

    $services = $containerConfigurator->services();

    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->load('Rector\\Symfony\\', __DIR__ . '/../src')
        ->exclude([__DIR__ . '/../src/{Rector,ValueObject}']);

    $services->set(RenameClassNonPhpRector::class);
    $services->set(SmartFileSystem::class);
};
