<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'secret' => 'onetwothree',
        'router' => [
            'resource' => '%kernel.project_dir%/config/routing.php',
            'strict_requirements' => null,
        ],
        'form' => null,
        'csrf_protection' => null,
        'validation' => [
            'enable_annotations' => true,
        ],
        'default_locale' => 'en',
        'fragments' => null,
        'http_method_override' => true,
        'session' => [
            'cookie_secure' => true,
            'handler_id' => SomeSessionHandler::class,
        ],
        'translator' => [
            'enabled' => false,
        ],
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\FrameworkConfig $frameworkConfig): void {
    $frameworkConfig->secret('onetwothree');
    $frameworkConfig->router(['resource' => '%kernel.project_dir%/config/routing.php', 'strict_requirements' => null]);
    $frameworkConfig->validation(['enable_annotations' => true]);
    $frameworkConfig->default_locale('en');
    $frameworkConfig->http_method_override(true);
    $frameworkConfig->session(['cookie_secure' => true, 'handler_id' => 'SomeSessionHandler']);
    $frameworkConfig->translator(['enabled' => false]);
};

?>
