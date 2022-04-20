<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Rector\StaticCall\BinaryFileResponseCreateToNewInstanceRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->rule(BinaryFileResponseCreateToNewInstanceRector::class);
};
