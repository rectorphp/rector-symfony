<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Contract\Bridge\Symfony\Routing\SymfonyRoutesProviderInterface;
use Rector\Symfony\Tests\ConfigList;
use Rector\Symfony\Configs\Rector\ClassMethod\AddRouteAnnotationRector;
use Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Source\DummySymfonyRoutesProvider;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(ConfigList::MAIN);
    $rectorConfig->rule(AddRouteAnnotationRector::class);

    // only for tests
    $rectorConfig->singleton(DummySymfonyRoutesProvider::class);

    // give this service autowiring preferences
    $rectorConfig->alias(SymfonyRoutesProviderInterface::class, DummySymfonyRoutesProvider::class);
};
