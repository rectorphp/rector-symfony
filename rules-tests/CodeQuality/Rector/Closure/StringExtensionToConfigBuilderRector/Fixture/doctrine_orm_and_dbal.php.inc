<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'dbal' => [
            'default_connection' => 'default',
        ],
        'orm' => [
            'some_value' => 'default',
        ],
    ]);
};

?>
-----
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Symfony\Config\DoctrineConfig $doctrineConfig) : void {
    $doctrineConfig->dbal()->defaultConnection('default');
    $doctrineConfig->orm()->someValue('default');
};

?>
