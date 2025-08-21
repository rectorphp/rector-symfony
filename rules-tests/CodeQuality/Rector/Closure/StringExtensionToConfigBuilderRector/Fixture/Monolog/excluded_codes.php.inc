<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('monolog', [
        'handlers' => [
            'main' => [
                'type' => 'firstType',
                'excluded_http_codes' => [400, 500]
            ],
        ],
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\MonologConfig $monologConfig): void {
    $monologConfig->handler('main')->type('firstType')->excludedHttpCode([400, 500]);
};

?>
