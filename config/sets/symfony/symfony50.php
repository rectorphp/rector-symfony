<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;

# https://github.com/symfony/symfony/blob/5.0/UPGRADE-5.0.md

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/symfony50-types.php');

    $services = $rectorConfig->services();

    $services->set(RenameClassRector::class)
        ->configure([
            'Symfony\Component\Debug\Debug' => 'Symfony\Component\ErrorHandler\Debug',
        ]);

    $services->set(RenameMethodRector::class)
        ->configure([
            new MethodCallRename('Symfony\Component\Console\Application', 'renderException', 'renderThrowable'),
            new MethodCallRename('Symfony\Component\Console\Application', 'doRenderException', 'doRenderThrowable'),
        ]);
};
