<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(AddTraitGetterReturnTypeBasedOnSetterRequiredRector::class);
};
