<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

// @see https://github.com/symfony/symfony/blob/6.4/UPGRADE-6.4.md
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            'Symfony\Component\HttpKernel\Debug\FileLinkFormatter' => 'Symfony\Component\ErrorHandler\ErrorRenderer\FileLinkFormatter',
        ],
    );

    $rectorConfig->import(__DIR__ . '/symfony64/symfony64-routing.php');
    $rectorConfig->import(__DIR__ . '/symfony64/symfony64-form.php');
    $rectorConfig->import(__DIR__ . '/symfony64/symfony64-http-foundation.php');
};
