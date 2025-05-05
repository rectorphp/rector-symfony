<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;

# https://github.com/symfony/symfony/blob/6.1/UPGRADE-6.0.md

return static function (RectorConfig $rectorConfig): void {
    // $rectorConfig->sets([SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES]);

    $rectorConfig->import(__DIR__ . '/symfony-return-types.php'); // todo: extract this as well

    $rectorConfig->import(__DIR__ . '/symfony60/symfony60-dependency-injection.php');
    $rectorConfig->import(__DIR__ . '/symfony60/symfony60-contracts.php');
    $rectorConfig->import(__DIR__ . '/symfony60/symfony60-config.php');
    $rectorConfig->import(__DIR__ . '/symfony60/symfony60-framework-bundle.php');
    $rectorConfig->import(__DIR__ . '/symfony60/symfony60-doctrine-bridge.php');

    $rectorConfig->ruleWithConfiguration(RenameMethodRector::class, [
        new MethodCallRename(
            'Symfony\Component\Security\Core\User\UserProviderInterface',
            'loadUserByUsername',
            'loadUserByIdentifier',
        ),
        // @see https://github.com/rectorphp/rector-symfony/issues/112
        new MethodCallRename(
            'Symfony\Component\Security\Core\User\UserInterface',
            'getUsername',
            'getUserIdentifier',
        ),
    ]);
};
