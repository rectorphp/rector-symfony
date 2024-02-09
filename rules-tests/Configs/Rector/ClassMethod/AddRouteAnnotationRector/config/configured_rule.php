<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Bridge\Symfony\Routing\SymfonyRoutesProvider;
use Rector\Symfony\Configs\Rector\ClassMethod\AddRouteAnnotationRector;
use Rector\Symfony\Contract\Bridge\Symfony\Routing\SymfonyRoutesProviderInterface;
use Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Source\DummySymfonyRoutesProvider;

return RectorConfig::configure()
    ->withRules([AddRouteAnnotationRector::class])
    // testing alias override, we need to use the 2nd service instead
    ->registerService(SymfonyRoutesProvider::class, SymfonyRoutesProviderInterface::class)
    // only for tests
    // give this service autowiring preferences
    ->registerService(DummySymfonyRoutesProvider::class, SymfonyRoutesProviderInterface::class);
