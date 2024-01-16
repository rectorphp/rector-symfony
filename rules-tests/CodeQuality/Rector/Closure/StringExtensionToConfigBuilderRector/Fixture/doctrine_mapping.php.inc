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
                        'shared_cards' => [
                            'is_bundle' => false,
                            'type' => 'annotation',
                            'dir' => '/some-path',
                            'prefix' => 'App\FirstNamespace',
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
    $doctrineConfig->orm()->entityManager('default')->namingStrategy('doctrine.orm.naming_strategy.underscore')->mapping('shared_cards')->isBundle(false)->type('annotation')->dir('/some-path')->prefix('App\FirstNamespace');
};

?>
