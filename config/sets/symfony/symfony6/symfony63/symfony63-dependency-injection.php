<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            // @see https://github.com/symfony/symfony/commit/b653adf426aedc66d16c5fc1cf71e261f20b9638
            'Symfony\Component\DependencyInjection\Attribute\MapDecorated' => 'Symfony\Component\DependencyInjection\Attribute\AutowireDecorated',
        ],
    );
};
