<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\RouteMap;

use Rector\Symfony\ValueObject\SymfonyRouteMetadata;

final class RouteMap
{
    /**
     * @param SymfonyRouteMetadata[] $routes
     */
    public function __construct(private readonly array $routes)
    {
    }

    public function hasRoutes(): bool
    {
        return $this->routes !== [];
    }

    public function getRouteByMethod(string $methodName): ?SymfonyRouteMetadata
    {
        foreach ($this->routes as $route) {
            if ($route->getDefault('_controller') === $methodName) {
                return $route;
            }
        }

        return null;
    }
}
