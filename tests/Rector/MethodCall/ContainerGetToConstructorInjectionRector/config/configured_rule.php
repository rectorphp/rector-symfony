<?php

use Rector\Core\Configuration\Option;
use Rector\Symfony\Rector\MethodCall\ContainerGetToConstructorInjectionRector;
use Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Source\ContainerAwareParentClass;
use Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Source\ContainerAwareParentCommand;
use Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\Source\ThisClassCallsMethodInConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER, __DIR__ . '/../xml/services.xml');

    $services = $containerConfigurator->services();
    $services->set(ContainerGetToConstructorInjectionRector::class)
        ->call('configure', [[
            ContainerGetToConstructorInjectionRector::CONTAINER_AWARE_PARENT_TYPES => [
                ContainerAwareParentClass::class,
                ContainerAwareParentCommand::class,
                ThisClassCallsMethodInConstructor::class,
            ],
        ]]
    );
};
