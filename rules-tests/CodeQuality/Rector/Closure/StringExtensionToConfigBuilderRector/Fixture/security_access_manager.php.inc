<?php

namespace Rector\Symfony\Tests\Rector\Closure\StringExtensionToConfigBuilderRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Closure\StringExtensionToConfigBuilderRector\Source\SomeUserProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'access_decision_manager' => [
            'strategy' => 'unanimous',
        ],
    ]);
};

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Closure\StringExtensionToConfigBuilderRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Closure\StringExtensionToConfigBuilderRector\Source\SomeUserProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\SecurityConfig $securityConfig): void {
    $securityConfig->accessDecisionManager()->strategy('unanimous');
};

?>
