<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'cache' => [
            'pools' => [
                'doctrine.result_cache_pool' => [
                    'adapter' => 'some_adapter',
                ],
                'doctrine.system_cache_pool' => [
                    'adapter' => 'another_adapter',
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

return static function (\Symfony\Config\FrameworkConfig $frameworkConfig): void {
    $frameworkConfig->cache()->pool('doctrine.result_cache_pool')->adapter('some_adapter');
    $frameworkConfig->cache()->pool('doctrine.system_cache_pool')->adapter('another_adapter');
};

?>
