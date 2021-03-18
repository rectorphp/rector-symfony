<?php

declare(strict_types=1);

namespace Rector\Symfony;

use Rector\Symfony\ValueObject\ServiceMap\ServiceMap;
use Rector\Symfony\ValueObjectFactory\ServiceMapFactory;
use Symplify\PackageBuilder\Parameter\ParameterProvider;
use Symplify\SmartFileSystem\SmartFileSystem;

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
     * @var SmartFileSystem
     */
    private $smartFileSystem;

    /**
     * @var ServiceMapFactory
     */
    private $serviceMapFactory;

    public function __construct(
        ParameterProvider $parameterProvider,
        ServiceMapFactory $serviceMapFactory,
        SmartFileSystem $smartFileSystem
    ) {
        $this->parameterProvider = $parameterProvider;
        $this->smartFileSystem = $smartFileSystem;
        $this->serviceMapFactory = $serviceMapFactory;
    }

    public function provide(): ServiceMap
    {
        $symfonyContainerXmlPath = $this->getSymfonyContainerXmlPath();
        if ($symfonyContainerXmlPath === '') {
            return new ServiceMap([]);
        }

        $fileContents = $this->smartFileSystem->readFile($symfonyContainerXmlPath);
        return $this->serviceMapFactory->createFromFileContent($fileContents, $symfonyContainerXmlPath);
    }

    private function getSymfonyContainerXmlPath(): string
    {
        return (string) $this->parameterProvider->provideParameter(self::SYMFONY_CONTAINER_XML_PATH_PARAMETER);
    }
}
