<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\ClassConstFetch\RenameClassConstFetchRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Renaming\ValueObject\RenameClassAndConstFetch;
use Rector\Renaming\ValueObject\RenameClassConstFetch;
use Rector\Symfony\Set\SymfonySetList;

# https://github.com/symfony/symfony/blob/5.x/UPGRADE-5.4.md

return static function (RectorConfig $rectorConfig): void {
    // $rectorConfig->sets([SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES]);

    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-validator.php');
    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-security-bundle.php');
    $rectorConfig->import(__DIR__ . '/symfony54/symfony54-security.php');

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        // @see https://github.com/symfony/symfony/pull/42050
        'Symfony\Component\Security\Http\Event\DeauthenticatedEvent' => 'Symfony\Component\Security\Http\Event\TokenDeauthenticatedEvent',
        // @see https://github.com/symfony/symfony/pull/42965
        'Symfony\Component\Cache\Adapter\DoctrineAdapter' => 'Doctrine\Common\Cache\Psr6\CacheAdapter',
        // @see https://github.com/symfony/symfony/pull/45615
        'Symfony\Component\HttpKernel\EventListener\AbstractTestSessionListener' => 'Symfony\Component\HttpKernel\EventListener\AbstractSessionListener',
        'Symfony\Component\HttpKernel\EventListener\TestSessionListener' => 'Symfony\Component\HttpKernel\EventListener\SessionListener',
        // @see https://github.com/symfony/symfony/pull/44271
        'Symfony\Component\Notifier\Bridge\Nexmo\NexmoTransportFactory' => 'Symfony\Component\Notifier\Bridge\Vonage\VonageTransportFactory',
        'Symfony\Component\Notifier\Bridge\Nexmo\NexmoTransport' => 'Symfony\Component\Notifier\Bridge\Vonage\VonageTransport',
    ]);
};
