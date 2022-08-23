<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceSetStringNameToClassNameRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServiceSetStringNameToClassNameRector\Source\AlreadyRenamedServiceType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('rector\symfony\tests\rector\methodcall\servicesetstringnametoclassnamerector\source\alreadyrenamedservicetype', AlreadyRenamedServiceType::class);
};
