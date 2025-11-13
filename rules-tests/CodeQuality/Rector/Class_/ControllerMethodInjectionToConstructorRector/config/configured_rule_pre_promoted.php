<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ControllerMethodInjectionToConstructorRector::class);
    $rectorConfig->phpVersion(\Rector\ValueObject\PhpVersionFeature::TYPED_PROPERTIES);
};
