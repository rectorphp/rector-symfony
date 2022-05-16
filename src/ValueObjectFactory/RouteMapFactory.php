<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObjectFactory;

use Rector\Symfony\Exception\JsonRoutesNotExistsException;
use Rector\Symfony\ValueObject\RouteMap\RouteMap;
use Rector\Symfony\ValueObject\SymfonyRouteMetadata;
use Symplify\SmartFileSystem\SmartFileSystem;

final class RouteMapFactory
{
    public function __construct(private readonly SmartFileSystem $smartFileSystem)
    {
    }

    public function createFromFileContent(string $configFilePath): RouteMap
    {
        $fileContents = $this->smartFileSystem->readFile($configFilePath);
        $json = json_decode($fileContents, true, 512, JSON_THROW_ON_ERROR);

        if ($json === false) {
            throw new JsonRoutesNotExistsException(\sprintf('Routes "%s" cannot be parsed', $configFilePath));
        }

        /** @var SymfonyRouteMetadata[] $routes */
        $routes = [];

        foreach ($json as $name => $def) {
            $routes[$name] = new SymfonyRouteMetadata(
                $name,
                $def['path'],
                $def['defaults'],
                $def['requirements'],
                $def['host'],
                $def['schemes'],
                $def['methods'],
                $def['condition'],
            );
        }

        return new RouteMap($routes);
    }

    public function createEmpty(): RouteMap
    {
        return new RouteMap([]);
    }
}
