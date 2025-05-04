<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        # https://github.com/symfony/symfony/commit/a7e319d9e1316e2e18843f8ce15b67a8693e5bf9
        'Symfony\Bundle\FrameworkBundle\Controller\Controller' => 'Symfony\Bundle\FrameworkBundle\Controller\AbstractController',
        # https://github.com/symfony/symfony/commit/744bf0e7ac3ecf240d0bf055cc58f881bb0b3ec0
    ]);
};
