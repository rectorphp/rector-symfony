<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony52\Rector\StaticCall\BinaryFileResponseCreateToNewInstanceRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(BinaryFileResponseCreateToNewInstanceRector::class);
};
