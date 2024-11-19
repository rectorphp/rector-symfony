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
                        'type' => 'pool2',
                        'pool' => 'doctrine.result_cache_pool2',
                    ],
                ],
                'extra' => [
                    'query_cache_driver' => [
                        'type' => 'bool',
                        'pool' => 'enabled',
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

return static function (\Symfony\Config\DoctrineConfig $doctrineConfig): void {
    $doctrineConfig->orm()->defaultEntityManager('default');
    $doctrineConfig->orm()->entityManager('default')->queryCacheDriver()->type('pool')->pool('doctrine.system_cache_pool')->resultCacheDriver()->type('pool2')->pool('doctrine.result_cache_pool2');
    $doctrineConfig->orm()->entityManager('extra')->queryCacheDriver()->type('bool')->pool('enabled');
};

?>
