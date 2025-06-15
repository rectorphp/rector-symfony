<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\JMS\Rector\Class_\AccessTypeAnnotationToAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(AccessTypeAnnotationToAttributeRector::class);
};
