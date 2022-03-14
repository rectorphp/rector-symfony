<?php

declare(strict_types=1);

use Rector\Symfony\Rector\MethodCall\LiteralGetToRequestClassConstantRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->set(LiteralGetToRequestClassConstantRector::class);
};
