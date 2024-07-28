<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\MergeServiceNameTypeRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\MergeServiceNameTypeRector\Source\SameNameAndType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SameNameAndType::class, SameNameAndType::class);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\MergeServiceNameTypeRector\Fixture;

use Rector\Symfony\Tests\Configs\Rector\Closure\MergeServiceNameTypeRector\Source\SameNameAndType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SameNameAndType::class);
};

?>
