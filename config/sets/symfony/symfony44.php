<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Symfony\Rector\ClassMethod\ConsoleExecuteReturnIntRector;
use Rector\Symfony\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector;

# https://github.com/symfony/symfony/blob/4.4/UPGRADE-4.4.md

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    # https://github.com/symfony/symfony/pull/33775
    $services->set(ConsoleExecuteReturnIntRector::class);

    # https://github.com/symfony/symfony/blob/4.4/UPGRADE-4.4.md#security
    $services->set(AuthorizationCheckerIsGrantedExtractorRector::class);
};
