<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Http\Discovery\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->alias(RequestFactoryInterface::class, 'http_discovery.psr17_factory');

    $services->alias(ResponseFactoryInterface::class, 'http_discovery.psr17_factory');

    $services->alias(ServerRequestFactoryInterface::class, 'http_discovery.psr17_factory');

    $services->alias(StreamFactoryInterface::class, 'http_discovery.psr17_factory');

    $services->alias(UploadedFileFactoryInterface::class, 'http_discovery.psr17_factory');

    $services->alias(UriFactoryInterface::class, 'http_discovery.psr17_factory');

    $services->set('http_discovery.psr17_factory', Psr17Factory::class);
};