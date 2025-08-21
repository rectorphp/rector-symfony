<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'orm' => [
            'query_cache_driver' => [
                'type' => 'pool',
                'pool' => 'pool_name_one',
            ],
            'result_cache_driver' => [
                'type' => 'pool',
                'pool' => 'pool_name_two',
            ],
        ],
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\DoctrineConfig $doctrineConfig): void {
    $doctrineConfig->orm()->entityManager('default')->queryCacheDriver()->type('pool')->pool('pool_name_one');
    $doctrineConfig->orm()->entityManager('default')->resultCacheDriver()->type('pool')->pool('pool_name_two');
};

?>
