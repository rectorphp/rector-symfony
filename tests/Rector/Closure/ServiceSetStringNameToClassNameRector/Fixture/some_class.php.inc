<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceSetStringNameToClassNameRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServiceSetStringNameToClassNameRector\Source\UniqueServiceType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('some_unique_name', UniqueServiceType::class);

    $services->alias('first_one', 'some_unique_name');
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceSetStringNameToClassNameRector\Fixture;

use Rector\Symfony\Tests\Rector\Closure\ServiceSetStringNameToClassNameRector\Source\UniqueServiceType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('rector\symfony\tests\rector\closure\servicesetstringnametoclassnamerector\source\uniqueservicetype', UniqueServiceType::class);

    $services->alias('first_one', 'rector\symfony\tests\rector\closure\servicesetstringnametoclassnamerector\source\uniqueservicetype');
};

?>
