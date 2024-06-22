<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony62\Rector\Class_\SecurityAttributeToIsGrantedAttributeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(SecurityAttributeToIsGrantedAttributeRector::class);
};
