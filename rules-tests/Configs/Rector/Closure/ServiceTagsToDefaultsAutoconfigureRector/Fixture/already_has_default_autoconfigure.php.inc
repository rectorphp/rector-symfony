<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceTagsToDefaultsAutoconfigureRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use App\Command\SomeCommand;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
         ->autowire()
         ->autoconfigure();

    $services->set(SomeCommand::class)
        ->tag('console.command');
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceTagsToDefaultsAutoconfigureRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use App\Command\SomeCommand;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
         ->autowire()
         ->autoconfigure();

    $services->set(SomeCommand::class);
};

?>
