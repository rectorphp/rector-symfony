<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\Symfony\Routing;

use Rector\Symfony\Bridge\Symfony\ContainerServiceProvider;
use Rector\Symfony\ValueObject\SymfonyRouteMetadata;
use Webmozart\Assert\Assert;

final class SymfonyRoutesProvider
{
    /**
     * @var SymfonyRouteMetadata[]
     */
    private array $symfonyRouteMetadatas = [];

    public function __construct(
        private readonly ContainerServiceProvider $containerServiceProvider
    ) {
    }

    /**
     * @return SymfonyRouteMetadata[]
     */
    public function provide(): array
    {
        if ($this->symfonyRouteMetadatas !== []) {
            return $this->symfonyRouteMetadatas;
        }

        $router = $this->containerServiceProvider->provideByName('router');
        Assert::isInstanceOf($router, 'Symfony\Component\Routing\RouterInterface');

        $routeCollection = $router->getRouteCollection();

        $symfonyRoutesMetadatas = array_map(
            static fn ($route): SymfonyRouteMetadata => new SymfonyRouteMetadata(
                name: '?',
                path: $route->getPath(),
                defaults: $route->getDefaults(),
                requirements: $route->getRequirements(),
                host: $route->getHost(),
                schemes: $route->getSchemes(),
                methods: $route->getMethods(),
                condition: $route->getCondition()
            ),
            $routeCollection->all()
        );

        $this->symfonyRouteMetadatas = $symfonyRoutesMetadatas;

        return $symfonyRoutesMetadatas;
    }

    public function hasRoutes(): bool
    {
        return $this->symfonyRouteMetadatas !== [];
    }

    /**
     * @param string $classMethodReference Format <class>::<method>
     */
    public function getRouteByClassMethodReference(string $classMethodReference): ?SymfonyRouteMetadata
    {
        foreach ($this->symfonyRouteMetadatas as $symfonyRouteMetadata) {
            if ($symfonyRouteMetadata->getDefault('_controller') === $classMethodReference) {
                return $symfonyRouteMetadata;
            }
        }

        return null;
    }
}
