<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\Source;

use Nette\Utils\FileSystem;
use Nette\Utils\Json;
use Rector\Symfony\Contract\Bridge\Symfony\Routing\SymfonyRoutesProviderInterface;
use Rector\Symfony\ValueObject\SymfonyRouteMetadata;

final class DummySymfonyRoutesProvider implements SymfonyRoutesProviderInterface
{
    /**
     * @var SymfonyRouteMetadata[]
     */
    private array $symfonyRoutesMetadatas = [];

    /**
     * @return SymfonyRouteMetadata[]
     */
    public function provide(): array
    {
        if ($this->symfonyRoutesMetadatas !== []) {
            return $this->symfonyRoutesMetadatas;
        }

        $routesFileContent = FileSystem::read(__DIR__ . '/../config/routes.json');
        $routesJson = Json::decode($routesFileContent, Json::FORCE_ARRAY);

        $symfonyRoutesMetadatas = array_map(
            static fn (array $route): SymfonyRouteMetadata => new SymfonyRouteMetadata(
                name: $route['name'],
                path: $route['path'],
                defaults: $route['defaults'],
                requirements: $route['requirements'],
                host: $route['host'],
                schemes: $route['schemes'],
                methods: $route['methods'],
                condition: $route['condition'],
                options: $route['options'],
            ),
            $routesJson
        );

        $this->symfonyRoutesMetadatas = $symfonyRoutesMetadatas;

        return $symfonyRoutesMetadatas;
    }

    public function getRouteByClassMethodReference(string $classMethodReference): ?SymfonyRouteMetadata
    {
        foreach ($this->provide() as $symfonyRouteMetadata) {
            if ($symfonyRouteMetadata->getDefault('_controller') === $classMethodReference) {
                return $symfonyRouteMetadata;
            }
        }

        return null;
    }
}
