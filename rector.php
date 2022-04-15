<?php

declare(strict_types=1);
use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (RectorConfig $rectorConfig): void {
    $parameters = $rectorConfig->parameters();

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // experimental
    $parameters->set(Option::PARALLEL, true);

    $parameters->set(Option::SKIP, [
        '*/Fixture/*',
        '*/Source/*',
        '*/Source*/*',
        '*/tests/*/Fixture*/Expected/*',
        StringClassNameToClassConstantRector::class => [
            __DIR__ . '/config',
        ],
    ]);

    $services = $rectorConfig->services();

    $services->set(StringClassNameToClassConstantRector::class)
        ->configure([
            'Symfony\*',
            'Twig_*',
            'Swift_*',
            'Doctrine\*',
        ]);

    $rectorConfig->import(LevelSetList::UP_TO_PHP_81);
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::NAMING);

    // for testing
    $rectorConfig->import(__DIR__ . '/config/config.php');
    $rectorConfig->import(SymfonySetList::SYMFONY_60);
};
