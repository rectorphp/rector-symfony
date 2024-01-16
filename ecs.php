<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths(
        [__DIR__ . '/src', __DIR__ . '/rules', __DIR__ . '/rules-tests', __DIR__ . '/tests', __DIR__ . '/config']
    )
    ->withRootFiles()
    ->withPreparedSets(psr12: true, symplify: true, common: true)
    ->withSkip(['*/Source/*', '*/Fixture/*', '*/Expected/*']);
