<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(TraitGetByTypeToInjectRector::class);
};
