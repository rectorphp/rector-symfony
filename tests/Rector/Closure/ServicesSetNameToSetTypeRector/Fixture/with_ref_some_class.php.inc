<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Source\SpecificClass;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('some_name', SpecificClass::class);

    $services->set(\App\AnotherClass::class)
        ->args([
            service('some_name'),
            ref('some_name'),
        ]);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Source\SpecificClass;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SpecificClass::class);

    $services->set(\App\AnotherClass::class)
        ->args([
            service(\Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Source\SpecificClass::class),
            ref(\Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Source\SpecificClass::class),
        ]);
};

?>
