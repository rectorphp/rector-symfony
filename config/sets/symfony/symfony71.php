<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Class_\RenameAttributeRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Renaming\ValueObject\RenameAttribute;

// @see https://github.com/symfony/symfony/blob/7.1/UPGRADE-7.1.md

return RectorConfig::configure()
    // @see https://github.com/symfony/symfony/blob/7.1/UPGRADE-7.1.md#dependencyinjection
    ->withConfiguredRule(RenameAttributeRector::class, [
        new RenameAttribute(
            'Symfony\Component\DependencyInjection\Attribute\TaggedIterator',
            'Symfony\Component\DependencyInjection\Attribute\AutowireIterator'
        ),
        new RenameAttribute(
            'Symfony\Component\DependencyInjection\Attribute\TaggedLocator',
            'Symfony\Component\DependencyInjection\Attribute\AutowireLocator'
        ),
    ])
    ->withConfiguredRule(RenameMethodRector::class, [
        // typo fix
        new MethodCallRename(
            '̈́Symfony\Component\Serializer\Context\Normalizer\AbstractNormalizerContextBuilder',
            'withDefaultContructorArguments',
            'withDefaultConstructorArguments',
        ),
    ]);
