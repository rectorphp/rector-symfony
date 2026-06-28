<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\String_\UseClassKeywordForClassNameResolutionRector;
use Rector\Config\RectorConfig;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php84\Rector\Class_\DeprecatedAnnotationToDeprecatedAttributeRector;
use Rector\Php85\Rector\Const_\ConstAndTraitDeprecatedAttributeRector;
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
        StringClassNameToClassConstantRector::class => [
            __DIR__ . '/config', __DIR__ . '/src/Enum',
            __DIR__ . '/rules/CodeQuality/Enum/',
        ],
        UseClassKeywordForClassNameResolutionRector::class => [__DIR__ . '/config'],

        // marked as skipped
        ReturnNeverTypeRector::class => ['*/tests/*'],

        // keep @deprecated docblocks on set list constants; the native
        // #[\Deprecated] attribute triggers PHP runtime deprecation notices
        // on internal access, see https://github.com/rectorphp/rector/issues/9788
        DeprecatedAnnotationToDeprecatedAttributeRector::class,
        ConstAndTraitDeprecatedAttributeRector::class,
    ])
    ->withConfiguredRule(StringClassNameToClassConstantRector::class, ['Symfony\*', 'Twig_*', 'Twig*'])
    ->withPhpSets()
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        typeDeclarationDocblocks: true,
        privatization: true,
        naming: true,
        rectorPreset: true,
        phpunitCodeQuality: true,
    )
    ->withImportNames(removeUnusedImports: true);
