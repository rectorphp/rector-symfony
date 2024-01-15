<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\DowngradeSymfony70\Rector\Class_\DowngradeSymfonyCommandAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(DowngradeSymfonyCommandAttributeRector::class);
};
