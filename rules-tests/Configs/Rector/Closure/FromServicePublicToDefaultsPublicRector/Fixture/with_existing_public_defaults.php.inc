<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceTagsToDefaultsAutoconfigureRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()->public();

    $services->set(NextCommand::class)
        ->public();
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceTagsToDefaultsAutoconfigureRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()->public();

    $services->set(NextCommand::class);
};

?>
