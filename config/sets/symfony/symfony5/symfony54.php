<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

# https://github.com/symfony/symfony/blob/5.x/UPGRADE-5.4.md

return static function (RectorConfig $rectorConfig): void {
    // $rectorConfig->sets([SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES]);

    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-validator.php');
    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-security-bundle.php');
    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-security.php');
    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-cache.php');
    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-http-kernel.php');

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        // @see https://github.com/symfony/symfony/pull/44271
        'Symfony\Component\Notifier\Bridge\Nexmo\NexmoTransportFactory' => 'Symfony\Component\Notifier\Bridge\Vonage\VonageTransportFactory',
        'Symfony\Component\Notifier\Bridge\Nexmo\NexmoTransport' => 'Symfony\Component\Notifier\Bridge\Vonage\VonageTransport',
    ]);
};
