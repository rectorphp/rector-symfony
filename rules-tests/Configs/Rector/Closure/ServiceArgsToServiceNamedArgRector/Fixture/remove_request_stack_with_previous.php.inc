<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithRequestStack;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithRequestStack::class)
        ->args([100, service('request_stack')]);
};

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceArgsToServiceNamedArgRector\Source\SomeClassWithRequestStack;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeClassWithRequestStack::class)->arg('$count', 100);
};

?>
