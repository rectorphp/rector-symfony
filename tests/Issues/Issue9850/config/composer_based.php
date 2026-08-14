<?php

declare(strict_types=1);

use Rector\Composer\InstalledPackageResolver;
use Rector\Config\RectorConfig;
use Rector\Util\Reflection\PrivatesAccessor;

return static function (RectorConfig $rectorConfig): void {
    $privatesAccessor = new PrivatesAccessor();
    $privatesAccessor->setPrivateProperty(
        $rectorConfig,
        'installedPackageResolver',
        new InstalledPackageResolver(composerJsonFilePath: __DIR__ . '/composer.json')
    );

    $rectorConfig->sets([__DIR__ . '/../../../../config/sets/symfony/composer-based.php']);

    $privatesAccessor->setPrivateProperty($rectorConfig, 'installedPackageResolver', null);
};
