<?php

namespace Rector\Symfony\Tests\Rector\Closure\StringExtensionToConfigBuilderRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Closure\StringExtensionToConfigBuilderRector\Source\SomeUserProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'access_control' => [
            [
                'path' => '^/first',
                'role' => 'PUBLIC_ACCESS',
            ],
            [
                'path' => '^/second',
                'role' => 'PUBLIC_ACCESS',
            ],
        ],
    ]);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\StringExtensionToConfigBuilderRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Closure\StringExtensionToConfigBuilderRector\Source\SomeUserProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\SecurityConfig $securityConfig) : void {
    $securityConfig->accessControl()->path('^/first')->roles(['PUBLIC_ACCESS']);
    $securityConfig->accessControl()->path('^/second')->roles(['PUBLIC_ACCESS']);
};

?>
