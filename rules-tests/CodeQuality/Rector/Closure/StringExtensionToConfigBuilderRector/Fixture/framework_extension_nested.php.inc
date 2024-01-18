<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'router' => [
            'resource' => '/some-routing.php',
            'strict_requirements' => true,
        ],
        'validation' => [
            'enable_annotations' => true,
        ],
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\FrameworkConfig $frameworkConfig) : void {
    $frameworkConfig->router()->resource('/some-routing.php')->strictRequirements(true);
    $frameworkConfig->validation()->enableAnnotations(true);
};

?>
