<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Arguments\ValueObject\ArgumentAdder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(ArgumentAdderRector::class)
        ->configure([
            new ArgumentAdder(
                'Symfony\Component\DependencyInjection\ContainerBuilder',
                'addCompilerPass',
                2,
                'priority',
                0
            ),
        ]);
};
