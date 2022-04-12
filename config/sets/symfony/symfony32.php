<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;

use Rector\Arguments\ValueObject\ArgumentAdder;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

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
