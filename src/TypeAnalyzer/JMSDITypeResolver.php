<?php

declare(strict_types=1);

namespace Rector\Symfony\TypeAnalyzer;

use PhpParser\Node\Stmt\Property;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Provider\CurrentFileProvider;
use Rector\Core\ValueObject\Application\File;
use Rector\Core\ValueObject\Application\RectorError;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\DataProvider\ServiceMapProvider;
use Rector\Symfony\ValueObject\ServiceMap\ServiceMap;

final class JMSDITypeResolver
{
    public function __construct(
        private ServiceMapProvider $serviceMapProvider,
        private PhpDocInfoFactory $phpDocInfoFactory,
        private ReflectionProvider $reflectionProvider,
        private NodeNameResolver $nodeNameResolver,
        private CurrentFileProvider $currentFileProvider
    ) {
    }

    public function resolve(
        Property $property,
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ): Type {
        $serviceMap = $this->serviceMapProvider->provide();

        $serviceName = $this->resolveServiceName($doctrineAnnotationTagValueNode, $property);

        $serviceType = $this->resolveFromServiceName($serviceName, $serviceMap);
        if (! $serviceType instanceof MixedType) {
            return $serviceType;
        }

        // 3. service is in @var annotation
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        $varType = $phpDocInfo->getVarType();
        if (! $varType instanceof MixedType) {
            return $varType;
        }

        // the @var is missing and service name was not found → report it
        $this->reportServiceNotFound($serviceName, $property);

        return new MixedType();
    }

    private function reportServiceNotFound(?string $serviceName, Property $property): void
    {
        if ($serviceName !== null) {
            return;
        }

        $file = $this->currentFileProvider->getFile();
        if (! $file instanceof File) {
            throw new ShouldNotHappenException();
        }

        $errorMessage = sprintf('Service "%s" was not found in DI Container of your Symfony App.', $serviceName);

        $rectorError = new RectorError($errorMessage, $file->getRelativeFilePath(), $property->getLine());
        $file->addRectorError($rectorError);
    }

    private function resolveFromServiceName(string $serviceName, ServiceMap $serviceMap): Type
    {
        // 1. service name-type
        if ($this->reflectionProvider->hasClass($serviceName)) {
            // single class service
            return new ObjectType($serviceName);
        }

        // 2. service name
        if ($serviceMap->hasService($serviceName)) {
            $serviceType = $serviceMap->getServiceType($serviceName);
            if ($serviceType !== null) {
                return $serviceType;
            }
        }

        return new MixedType();
    }

    private function resolveServiceName(
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode,
        Property $property
    ): string {
        $serviceNameParameter = $doctrineAnnotationTagValueNode->getValueWithoutQuotes('serviceName');
        if (is_string($serviceNameParameter)) {
            return $serviceNameParameter;
        }

        $silentValue = $doctrineAnnotationTagValueNode->getSilentValue();
        if (is_string($silentValue)) {
            return $silentValue;
        }

        return $this->nodeNameResolver->getName($property);
    }
}
