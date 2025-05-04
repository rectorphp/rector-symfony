<?php

declare(strict_types=1);

use Rector\Symfony\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([ContainerGetNameToTypeInTestsRector::class]);
};
