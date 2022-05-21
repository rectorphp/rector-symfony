<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames();
    $rectorConfig->paths([__DIR__ . '/src', __DIR__ . '/tests']);

    $rectorConfig->parallel();

    $rectorConfig->skip([
        '*/Fixture/*',
        '*/Source/*',
        '*/Source*/*',
        '*/tests/*/Fixture*/Expected/*',
        StringClassNameToClassConstantRector::class => [__DIR__ . '/config'],
    ]);

    $rectorConfig->ruleWithConfiguration(StringClassNameToClassConstantRector::class, [
        'Symfony\*',
        'Twig_*',
        'Swift_*',
        'Doctrine\*',
        // loaded from project itself
        'Psr\Container\ContainerInterface',
        'Symfony\Component\Routing\RouterInterface',
        'Symfony\Component\DependencyInjection\Container',
    ]);

    // for testing
    $rectorConfig->import(__DIR__ . '/config/config.php');

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::NAMING,
        SymfonySetList::SYMFONY_60,
    ]);
};
