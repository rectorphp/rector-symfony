<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony52\Rector\New_\PropertyPathMapperToDataMapperRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../../config/config.php');

    $rectorConfig->rule(PropertyPathMapperToDataMapperRector::class);
};
