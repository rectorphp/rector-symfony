<?php

declare(strict_types=1);

namespace Rector\Symfony\Contract\Bridge\Symfony\Routing;

use Rector\Symfony\ValueObject\SymfonyRouteMetadata;

interface SymfonyRouterProviderInterface
{
    /**
     * @return SymfonyRouteMetadata[]
     */
    public function provide(): array;

    public function hasRoutes(): bool;

    /**
     * @param string $classMethodReference Format <class>::<method>
     */
    public function getRouteByClassMethodReference(string $classMethodReference): ?SymfonyRouteMetadata;
}
