<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);
    $parameters->set(Option::SKIP, [
        // waits for phpstan to use php-parser 4.13
        RemoveDeadInstanceOfRector::class,
        '*/Fixture/*',
        '*/Source/*',
    ]);

    $containerConfigurator->import(SetList::PHP_74);
    $containerConfigurator->import(SetList::PHP_80);
    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::CODE_QUALITY);
};
