<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Contract\Bridge\Symfony\Routing\SymfonyRoutesProviderInterface;
use Rector\Symfony\Rector\ClassMethod\AddRouteAnnotationRector;
use Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\Source\DummySymfonyRoutesProvider;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->rule(AddRouteAnnotationRector::class);

    // only for tests
    $services = $rectorConfig->services();
    $services->set(DummySymfonyRoutesProvider::class);

    // give this service autowiring preferences
    $services->alias(SymfonyRoutesProviderInterface::class, DummySymfonyRoutesProvider::class);
};
