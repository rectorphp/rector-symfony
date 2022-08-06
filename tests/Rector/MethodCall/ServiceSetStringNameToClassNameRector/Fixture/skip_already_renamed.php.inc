<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ServiceSetStringNameToClassNameRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\ServiceSetStringNameToClassNameRector\Source\SomeServiceType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('rector\symfony\tests\rector\methodcall\servicesetstringnametoclassnamerector\source\someservicetype', SomeServiceType::class);
};
