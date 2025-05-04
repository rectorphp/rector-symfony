<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

/**
 * @resource https://github.com/symfony/symfony/blob/3.4/UPGRADE-3.0.md
 */
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-class-loader.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-console.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-forms.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-security.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-process.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-property-access.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-http-foundation.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-http-kernel.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-validator.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-translation.php');
    $rectorConfig->import(__DIR__ . '/symfony30/symfony30-bridge-monolog.php');

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        // twig
        'Symfony\Bundle\TwigBundle\TwigDefaultEscapingStrategy' => 'Twig_FileExtensionEscapingStrategy',

        // swift mailer
        'Symfony\Bridge\Swiftmailer\DataCollector\MessageDataCollector' => 'Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector',
    ]);
};
