<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'dbal' => [
            'connections' => [
                'default' => [
                    'mapping_types' => [
                        'enum' => 'string',
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
    $doctrineConfig->dbal()->connection('default')->mappingType('enum', 'string');
};

?>
