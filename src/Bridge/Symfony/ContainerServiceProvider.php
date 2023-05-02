<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\Symfony;

use Rector\Core\Configuration\RectorConfigProvider;
use Rector\Core\Exception\ShouldNotHappenException;
use Symfony\Component\DependencyInjection\Container;
use Webmozart\Assert\Assert;

final class ContainerServiceProvider
{
    private ?object $container = null;

    public function __construct(
        private readonly RectorConfigProvider $rectorConfigProvider
    ) {
    }

    public function provideByName(string $serviceName): object
    {
        /** @var Container $container */
        $container = $this->getSymfonyContainer();
        if (! $container->has($serviceName)) {
            $errorMessage = sprintf('Symfony container has no service "%s", maybe it is private', $serviceName);
            throw new ShouldNotHappenException($errorMessage);
        }

        return $container->get($serviceName);
    }

    private function getSymfonyContainer(): object
    {
        if ($this->container === null) {
            $symfonyContainerPhp = $this->rectorConfigProvider->getSymfonyContainerPhp();
            Assert::fileExists($symfonyContainerPhp);

            $container = require $symfonyContainerPhp;

            // this allows older Symfony versions, e.g. 2.8 did not have the PSR yet
            Assert::isInstanceOf($container, 'Symfony\Component\DependencyInjection\Container');
            $this->container = $container;
        }

        return $this->container;
    }
}
