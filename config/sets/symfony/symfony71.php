<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Class_\RenameAttributeRector;
use Rector\Renaming\ValueObject\RenameAttribute;

// @see https://github.com/symfony/symfony/blob/7.1/UPGRADE-7.1.md
return static function (RectorConfig $rectorConfig): void {
    // @see https://github.com/symfony/symfony/blob/7.1/UPGRADE-7.1.md#dependencyinjection
    $rectorConfig->ruleWithConfiguration(RenameAttributeRector::class, [
        new RenameAttribute(
            'Symfony\Component\DependencyInjection\Attribute\TaggedIterator',
            'Symfony\Component\DependencyInjection\Attribute\AutowireIterator'
        ),
        new RenameAttribute(
            'Symfony\Component\DependencyInjection\Attribute\TaggedLocator',
            'Symfony\Component\DependencyInjection\Attribute\AutowireLocator'
        ),
    ]);
};
