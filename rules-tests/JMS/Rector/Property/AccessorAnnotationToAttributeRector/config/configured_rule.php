<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\JMS\Rector\Property\AccessorAnnotationToAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(AccessorAnnotationToAttributeRector::class);
};
