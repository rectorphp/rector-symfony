<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\Symfony;

use Rector\Core\Configuration\RectorConfigProvider;
use Rector\Core\Exception\ShouldNotHappenException;
use Webmozart\Assert\Assert;

final class ContainerServiceProvider
{
    public function __construct(
        private readonly RectorConfigProvider $rectorConfigProvider
    ) {
    }

    public function provideByName(string $serviceName): object
    {
        $symfonyContainerPhp = $this->rectorConfigProvider->getSymfonyContainerPhp();
        Assert::fileExists($symfonyContainerPhp);

        $container = require_once $symfonyContainerPhp;

        // this allows older Symfony versions, e.g. 2.8 did not have the PSR yet
        Assert::isInstanceOf($container, 'Symfony\Component\DependencyInjection\Container');

        if (! $container->has($serviceName)) {
            $errorMessage = sprintf('Symfony container has no service "%s", maybe it is private', 'router');
            throw new ShouldNotHappenException($errorMessage);
        }

        return $container->get($serviceName);
    }
}
