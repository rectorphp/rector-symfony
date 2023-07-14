<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\GrandChildClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(GrandChildClassWithConstructor::class)
        ->args([
            1 => 'some_value'
        ]);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\GrandChildClassWithConstructor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(GrandChildClassWithConstructor::class)->arg('$anotherCtorParameter', 'some_value');
};

?>
