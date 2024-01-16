<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'orm' => [
            'default_entity_manager' => 'default',
            'entity_managers' => [
                'default' => [
                    'query_cache_driver' => [
                        'type' => 'pool',
                        'pool' => 'doctrine.system_cache_pool',
                    ],
                    'result_cache_driver' => [
                        'type' => 'pool',
                        'pool' => 'doctrine.result_cache_pool',
                    ],
                ]
            ]
        ]
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\DoctrineConfig $doctrineConfig) : void {
    $doctrineConfig->dbal()->defaultConnection('default');
    $doctrineConfig->dbal()->connection('default')->driver('pdo_pgsql')->host('%database_host%');
};

?>
