<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;

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

    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        // monolog
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'emerg', 'emergency'),
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'crit', 'critical'),
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'err', 'error'),
        new MethodCallRename('Symfony\Bridge\Monolog\Logger', 'warn', 'warning'),

        // translator
        new MethodCallRename('Symfony\Component\Translation\Dumper\FileDumper', 'format', 'formatCatalogue'),
        new MethodCallRename('Symfony\Component\Translation\Translator', 'getMessages', 'getCatalogue'),
    ]);

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        // partial with method rename
        'Symfony\Bridge\Monolog\Logger' => 'Psr\Log\LoggerInterface',

        // twig
        'Symfony\Bundle\TwigBundle\TwigDefaultEscapingStrategy' => 'Twig_FileExtensionEscapingStrategy',

        // swift mailer
        'Symfony\Bridge\Swiftmailer\DataCollector\MessageDataCollector' => 'Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector',
    ]);
};
