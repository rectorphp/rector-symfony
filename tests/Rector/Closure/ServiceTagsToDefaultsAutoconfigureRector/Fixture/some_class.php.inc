<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceTagsToDefaultsAutoconfigureRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use App\Command\SomeCommand;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(SomeCommand::class)
        ->tag('console.command');
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\ServiceTagsToDefaultsAutoconfigureRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use App\Command\SomeCommand;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->defaults()->autoconfigure();

    $services->set(SomeCommand::class);
};

?>
