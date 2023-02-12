<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithConstructor::class)
        ->args(['some_value']);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithConstructor::class)->arg('$someCtorParameter', 'some_value');
};

?>
