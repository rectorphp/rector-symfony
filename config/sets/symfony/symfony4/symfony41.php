<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
<<<<<<< HEAD
<<<<<<< HEAD

# https://github.com/symfony/symfony/blob/master/UPGRADE-4.1.md
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-console.php');
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-http-foundation.php');
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-workflow.php');
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-framework-bundle.php');

=======
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Renaming\ValueObject\MethodCallRenameWithArrayKey;
=======
>>>>>>> 0f95e7a ([symfony 4.1] split to particular configs)

return static function (RectorConfig $rectorConfig): void {
<<<<<<< HEAD
    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        # https://github.com/symfony/symfony/commit/463f986c28a497571967e37c1314e9911f1ef6ba
        new MethodCallRename(
            'Symfony\Component\Console\Helper\TableStyle',
            'setHorizontalBorderChar',
            'setHorizontalBorderChars'
        ),
        # https://github.com/symfony/symfony/commit/463f986c28a497571967e37c1314e9911f1ef6ba
        new MethodCallRename(
            'Symfony\Component\Console\Helper\TableStyle',
            'setVerticalBorderChar',
            'setVerticalBorderChars'
        ),
        # https://github.com/symfony/symfony/commit/463f986c28a497571967e37c1314e9911f1ef6ba
        new MethodCallRename(
            'Symfony\Component\Console\Helper\TableStyle',
            'setCrossingChar',
            'setDefaultCrossingChar'
        ),

        # https://github.com/symfony/symfony/commit/463f986c28a497571967e37c1314e9911f1ef6ba
        new MethodCallRenameWithArrayKey(
            'Symfony\Component\Console\Helper\TableStyle',
            'getVerticalBorderChar',
            # special case to "getVerticalBorderChar" → "getBorderChars()[3]"
            'getBorderChars',
            3
        ),
        # https://github.com/symfony/symfony/commit/463f986c28a497571967e37c1314e9911f1ef6ba
        new MethodCallRenameWithArrayKey(
            'Symfony\Component\Console\Helper\TableStyle',
            'getHorizontalBorderChar',
            'getBorderChars',
            2
        ),
    ]);
>>>>>>> b7c411c (move)
=======
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-console.php');
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-http-foundation.php');
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-workflow.php');
    $rectorConfig->import(__DIR__ . '/symfony41/symfony41-framework-bundle.php');

>>>>>>> 0f95e7a ([symfony 4.1] split to particular configs)
};
