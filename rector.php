<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Naming\Rector\Foreach_\RenameForeachValueVariableToMatchMethodCallReturnTypeRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames();
    $rectorConfig->removeUnusedImports();

    $rectorConfig->paths([
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/rules',
        __DIR__ . '/rules-tests',
    ]);

    $rectorConfig->skip([
        '*/Fixture/*',
        '*/Source/*',
        '*/Source*/*',
        '*/tests/*/Fixture*/Expected/*',
        StringClassNameToClassConstantRector::class => [__DIR__ . '/config'],

        RenameForeachValueVariableToMatchMethodCallReturnTypeRector::class => [
            // "data" => "datum" false positive
            __DIR__ . '/src/Rector/ClassMethod/AddRouteAnnotationRector.php',
        ],

        // marked as skipped
        ReturnNeverTypeRector::class => ['*/tests/*'],
    ]);

    $rectorConfig->ruleWithConfiguration(StringClassNameToClassConstantRector::class, [
        'Error',
        'Exception',
        'Symfony\*',
        'Twig_*',
        'Twig*',
        'Swift_*',
        'Doctrine\*',
        // loaded from project itself
        'Psr\Container\ContainerInterface',
        'Symfony\Component\Routing\RouterInterface',
        'Symfony\Component\DependencyInjection\Container',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82,
        \Rector\PHPUnit\Set\PHPUnitSetList::PHPUNIT_100,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
        SetList::PRIVATIZATION,
        SetList::NAMING,
    ]);
};
