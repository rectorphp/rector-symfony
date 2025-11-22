<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths(
        [__DIR__ . '/src', __DIR__ . '/rules', __DIR__ . '/rules-tests', __DIR__ . '/tests', __DIR__ . '/config']
    )
    ->withRootFiles()
    ->withPreparedSets(psr12: true, symplify: true, common: true, strict: true)
    ->withSkip([
        '*/Source/*',
        '*/Fixture/*',
        '*/Expected/*',

        // skip change "\\Entity" to '\\Entity as cause removed the \\ on scoped build
        SingleQuoteFixer::class => [
            __DIR__ . '/rules/CodeQuality/Rector/Class_/ControllerMethodInjectionToConstructorRector.php',
        ],
    ]);
