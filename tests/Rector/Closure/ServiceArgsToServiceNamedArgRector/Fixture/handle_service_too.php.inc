<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithConstructor::class)
        ->args([ref('SomeService')]);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithConstructor::class)->arg('$someCtorParameter', ref('SomeService'));
};

?>
