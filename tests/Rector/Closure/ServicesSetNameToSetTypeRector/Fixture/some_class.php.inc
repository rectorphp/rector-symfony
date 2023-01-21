<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('some_name', App\SomeClass::class);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServicesSetNameToSetTypeRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(App\SomeClass::class);
};

?>
