<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector;
use Rector\ValueObject\PhpVersionFeature;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ControllerMethodInjectionToConstructorRector::class);
    $rectorConfig->phpVersion(PhpVersionFeature::TYPED_PROPERTIES);
};
