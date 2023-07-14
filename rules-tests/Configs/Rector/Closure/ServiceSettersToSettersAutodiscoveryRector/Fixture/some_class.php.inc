<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector\Source\FirstAutowiredClass;
use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector\Source\SecondAutowiredClass;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(FirstAutowiredClass::class);
    $services->set(SecondAutowiredClass::class);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector\Source\FirstAutowiredClass;
use Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector\Source\SecondAutowiredClass;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->load('Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector\Source\\', __DIR__ . '/../Source/');
};

?>
