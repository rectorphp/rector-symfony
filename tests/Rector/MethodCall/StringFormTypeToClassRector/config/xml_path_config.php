<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Symfony\Rector\MethodCall\StringFormTypeToClassRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER, __DIR__ . '/../Source/custom_container.xml');

    $services = $containerConfigurator->services();
    $services->set(StringFormTypeToClassRector::class);
};
