<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'dbal' => [
            'default_connection' => 'default',
            'connections' => [
                'default' => [
                    'driver' => 'pdo_pgsql',
                    'host' => '%database_host%',
                ],
            ],
        ],
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\FrameworkConfig $frameworkConfig) : void {
    $frameworkConfig->secret('onetwothree');
    $frameworkConfig->router(['resource' => '%kernel.project_dir%/config/routing.php', 'strict_requirements' => null]);
    $frameworkConfig->validation(['enable_annotations' => true]);
    $frameworkConfig->defaultLocale('en');
    $frameworkConfig->httpMethodOverride(true);
    $frameworkConfig->session(['cookie_secure' => true, 'handler_id' => 'SomeSessionHandler']);
    $frameworkConfig->translator(['enabled' => false]);
};

?>
