<?php

declare(strict_types=1);

namespace Rector\Symfony\DataProvider;

use Rector\Core\Configuration\Option;
use Rector\Symfony\ValueObject\RouteMap\RouteMap;
use Rector\Symfony\ValueObjectFactory\RouteMapFactory;
use Symplify\PackageBuilder\Parameter\ParameterProvider;

final class RouteMapProvider
{
    public function __construct(
        private readonly ParameterProvider $parameterProvider,
        private readonly RouteMapFactory $routeMapFactory
    ) {
    }

    public function provide(): RouteMap
    {
        $symfonyRoutesJsonPath = (string) $this->parameterProvider->provideParameter(
            Option::SYMFONY_ROUTES_JSON_PATH_PARAMETER
        );

        if ($symfonyRoutesJsonPath === '') {
            return $this->routeMapFactory->createEmpty();
        }

        return $this->routeMapFactory->createFromFileContent($symfonyRoutesJsonPath);
    }
}
