<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\Rector\Reflection;

use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\Type;
use Rector\Reflection\ReflectionResolver;
use Rector\ValueObject\MethodName;

final readonly class ConstructorReflectionTypesResolver
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
        private ReflectionResolver $reflectionResolver,
    ) {
    }

    /**
     * @return array<string, Type>|null
     */
    public function resolve(string $serviceClass): ?array
    {
        if (! $this->reflectionProvider->hasClass($serviceClass)) {
            return null;
        }

        $constructorReflection = $this->reflectionResolver->resolveMethodReflection(
            $serviceClass,
            MethodName::CONSTRUCT,
            null
        );

        if (! $constructorReflection instanceof MethodReflection) {
            return null;
        }

        return $this->resolveMethodReflectionParameterTypes($constructorReflection);
    }

    /**
     * @return array<string, Type>
     */
    private function resolveMethodReflectionParameterTypes(MethodReflection $methodReflection): array
    {
        $extendedParametersAcceptor = ParametersAcceptorSelector::combineAcceptors($methodReflection->getVariants());
        $constructorTypes = [];

        foreach ($extendedParametersAcceptor->getParameters() as $extendedParameterReflection) {
            $constructorTypes[$extendedParameterReflection->getName()] = $extendedParameterReflection->getType();
        }

        return $constructorTypes;
    }
}
