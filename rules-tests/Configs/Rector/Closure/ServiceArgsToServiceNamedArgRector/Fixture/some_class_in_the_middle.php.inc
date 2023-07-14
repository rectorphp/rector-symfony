<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithConstructor::class)
        ->args([
            1 => 'second_arg'
       ]);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithConstructor::class)->arg('$anotherCtorParameter', 'second_arg');
};

?>
