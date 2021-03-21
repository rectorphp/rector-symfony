<?php

declare(strict_types=1);

namespace Rector\Symfony\DataProvider;

use Rector\Symfony\ValueObject\ServiceMap\ServiceMap;
use Rector\Symfony\ValueObjectFactory\ServiceMapFactory;
use Symplify\PackageBuilder\Parameter\ParameterProvider;

/**
 * Inspired by https://github.com/phpstan/phpstan-symfony/tree/master/src/Symfony
 */
final class ServiceMapProvider
{
    /**
     * @var string
     */
    private const SYMFONY_CONTAINER_XML_PATH_PARAMETER = 'symfony_container_xml_path';

    /**
     * @var ParameterProvider
     */
    private $parameterProvider;

    /**
     * @var ServiceMapFactory
     */
    private $serviceMapFactory;

    public function __construct(ParameterProvider $parameterProvider, ServiceMapFactory $serviceMapFactory)
    {
        $this->parameterProvider = $parameterProvider;
        $this->serviceMapFactory = $serviceMapFactory;
    }

    public function provide(): ServiceMap
    {
        $symfonyContainerXmlPath = (string) $this->parameterProvider->provideParameter(
            self::SYMFONY_CONTAINER_XML_PATH_PARAMETER
        );

        if ($symfonyContainerXmlPath === '') {
            return $this->serviceMapFactory->createEmpty();
        }

        return $this->serviceMapFactory->createFromFileContent($symfonyContainerXmlPath);
    }
}
