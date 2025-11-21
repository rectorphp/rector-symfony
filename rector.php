<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Naming\Rector\Foreach_\RenameForeachValueVariableToMatchMethodCallReturnTypeRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;

return RectorConfig::configure()
    ->withImportNames(removeUnusedImports: true)
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/rules',
        __DIR__ . '/rules-tests',
    ])
    ->withRootFiles()
    ->withSkip([
        '*/Fixture/*',
        '*/Source/*',
        '*/Source*/*',
        '*/tests/*/Fixture*/Expected/*',
        StringClassNameToClassConstantRector::class => [__DIR__ . '/config'],
        \Rector\CodingStyle\Rector\String_\UseClassKeywordForClassNameResolutionRector::class => [__DIR__ . '/config'],

        RenameForeachValueVariableToMatchMethodCallReturnTypeRector::class => [
            // "data" => "datum" false positive
            __DIR__ . '/src/Rector/ClassMethod/AddRouteAnnotationRector.php',
        ],

        // marked as skipped
        ReturnNeverTypeRector::class => ['*/tests/*'],
    ])
    ->withConfiguredRule(StringClassNameToClassConstantRector::class, [
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
    ])
    ->withPhpSets()
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        naming: true,
        rectorPreset: true,
        phpunitCodeQuality: true,
    )
    ->withImportNames(removeUnusedImports: true);
