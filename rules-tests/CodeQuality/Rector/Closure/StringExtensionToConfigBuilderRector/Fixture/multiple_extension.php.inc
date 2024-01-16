<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'secret' => 'onetwothree',
    ]);

    $containerConfigurator->extension('security', [
        'enable_authenticator_manager' => true,
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
