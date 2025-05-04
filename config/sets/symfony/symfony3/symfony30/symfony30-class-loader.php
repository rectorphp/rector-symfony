<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        new MethodCallRename(
            'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader',
            'registerNamespaces',
            'addPrefixes'
        ),
        new MethodCallRename(
            'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader',
            'registerPrefixes',
            'addPrefixes'
        ),
        new MethodCallRename(
            'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader',
            'registerNamespace',
            'addPrefix'
        ),
        new MethodCallRename(
            'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader',
            'registerPrefix',
            'addPrefix'
        ),
        new MethodCallRename(
            'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader',
            'getNamespaces',
            'getPrefixes'
        ),
        new MethodCallRename(
            'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader',
            'getNamespaceFallbacks',
            'getFallbackDirs'
        ),
        new MethodCallRename(
            'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader',
            'getPrefixFallbacks',
            'getFallbackDirs'
        ),
    ]);

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        'Symfony\Component\ClassLoader\UniversalClassLoader\UniversalClassLoader' => 'Symfony\Component\ClassLoader\ClassLoader',
    ]);
};
