<?php

declare(strict_types=1);

namespace Rector\Symfony\DataProvider;

use Rector\Core\Configuration\Option;
use Rector\Core\Configuration\Parameter\SimpleParameterProvider;
use Rector\Symfony\ValueObject\ServiceMap\ServiceMap;
use Rector\Symfony\ValueObjectFactory\ServiceMapFactory;

/**
 * Inspired by https://github.com/phpstan/phpstan-symfony/tree/master/src/Symfony
 */
final class ServiceMapProvider
{
    public function __construct(
        private readonly ServiceMapFactory $serviceMapFactory,
        private ?ServiceMap $serviceMap = null
    ) {
    }

    public function provide(): ServiceMap
    {
        if ($this->serviceMap instanceof ServiceMap) {
            return $this->serviceMap;
        }

        if (SimpleParameterProvider::hasParameter(Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER)) {
            $symfonyContainerXmlPath = SimpleParameterProvider::provideStringParameter(
                Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER
            );
            $this->serviceMap = $this->serviceMapFactory->createFromFileContent($symfonyContainerXmlPath);
        } else {
            $this->serviceMap = $this->serviceMapFactory->createEmpty();
        }

        return $this->serviceMap;
    }
}
