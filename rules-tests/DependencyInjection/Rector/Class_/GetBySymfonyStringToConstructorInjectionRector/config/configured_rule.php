<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(GetBySymfonyStringToConstructorInjectionRector::class);
};
