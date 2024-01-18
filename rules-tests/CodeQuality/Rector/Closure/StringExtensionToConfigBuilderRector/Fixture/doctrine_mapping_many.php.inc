<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'orm' => [
            'entity_managers' => [
                'default' => [
                    'naming_strategy' => 'doctrine.orm.naming_strategy.underscore',
                    'mappings' => [
                        'unique_items' => [
                            'is_bundle' => false,
                            'type' => 'annotation',
                            'dir' => '/some-path',
                            'prefix' => 'App\FirstNamespace',
                        ],
                        'shared_hearts' => [
                            'is_bundle' => false,
                            'type' => 'annotation',
                            'dir' => '/another-path',
                            'prefix' => 'App\SecondNamespace',
                        ],
                    ],
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

return static function (\Symfony\Config\DoctrineConfig $doctrineConfig): void {
    $doctrineConfig->orm()->entityManager('default')->namingStrategy('doctrine.orm.naming_strategy.underscore')->mapping('unique_items')->isBundle(false)->type('annotation')->dir('/some-path')->prefix('App\FirstNamespace')->mapping('shared_hearts')->isBundle(false)->type('annotation')->dir('/another-path')->prefix('App\SecondNamespace');
};

?>
