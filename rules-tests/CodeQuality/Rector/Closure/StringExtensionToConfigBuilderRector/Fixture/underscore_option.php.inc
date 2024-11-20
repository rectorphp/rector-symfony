<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'default_locale' => 'en',
        'http_method_override' => true,
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\FrameworkConfig $frameworkConfig): void {
    $frameworkConfig->defaultLocale('en');
    $frameworkConfig->httpMethodOverride(true);
};

?>
