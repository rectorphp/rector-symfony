<?php

namespace Rector\Symfony\Tests\Rector\Closure\StringExtensionToConfigBuilderRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {

    $containerConfigurator->extension('security', [
        'entity' => [
            'class' => 'App\SomeClass',
            'property' => 'apiKey',
        ],
    ]);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\StringExtensionToConfigBuilderRector\Fixture;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\SecurityConfig $securityConfig): void {

    $securityConfig->entity()->class('App\SomeClass')->property('apiKey');
};

?>
