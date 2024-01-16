<?php

namespace Rector\Symfony\Tests\Rector\Closure\StringExtensionToConfigBuilderRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Closure\StringExtensionToConfigBuilderRector\Source\SomeUserProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'providers' => [
            'webservice' => [
                'id' => SomeUserProvider::class,
            ],
        ],
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false,
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
    $securityConfig->provider()->id('Rector\Symfony\Tests\CodeQuality\Rector\Closure\StringExtensionToConfigBuilderRector\Source\SomeUserProvider');
    $securityConfig->firewall()->pattern('^/(_(profiler|wdt)|css|images|js)/')->security(false);
};

?>
