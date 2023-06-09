<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\ObjectType;
use Rector\Core\NodeManipulator\PropertyManipulator;
use Rector\Naming\Naming\PropertyNaming;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Php80\NodeAnalyzer\PromotedPropertyResolver;
use Rector\PostRector\ValueObject\PropertyMetadata;

final class DependencyInjectionMethodCallAnalyzer
{
    public function __construct(
        private readonly PropertyNaming $propertyNaming,
        private readonly ServiceTypeMethodCallResolver $serviceTypeMethodCallResolver,
        private readonly PromotedPropertyResolver $promotedPropertyResolver,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly PropertyManipulator $propertyManipulator
    ) {
    }

    public function replaceMethodCallWithPropertyFetchAndDependency(
        Class_ $class,
        MethodCall $methodCall
    ): ?PropertyMetadata {
        $serviceType = $this->serviceTypeMethodCallResolver->resolve($methodCall);
        if (! $serviceType instanceof ObjectType) {
            return null;
        }

        $resolvedPropertyNameByType = $this->propertyManipulator->resolveExistingClassPropertyNameByType(
            $class,
            $serviceType
        );

        if (is_string($resolvedPropertyNameByType)) {
            $propertyName = $resolvedPropertyNameByType;
        } else {
            $propertyName = $this->propertyNaming->fqnToVariableName($serviceType);
            $propertyName = $this->resolveNewPropertyNameWhenExists($class, $propertyName, $propertyName);
        }

        // @note this has troubles to propagate up
        return new PropertyMetadata($propertyName, $serviceType, Class_::MODIFIER_PRIVATE);
    }

    private function resolveNewPropertyNameWhenExists(
        Class_ $class,
        string $originalPropertyName,
        string $propertyName,
        int $count = 1
    ): string {
        $lastCount = substr($propertyName, strlen($originalPropertyName));

        if (is_numeric($lastCount)) {
            $count = (int) $lastCount;
        }

        $promotedPropertyParams = $this->promotedPropertyResolver->resolveFromClass($class);
        foreach ($promotedPropertyParams as $promotedPropertyParam) {
            if ($this->nodeNameResolver->isName($promotedPropertyParam->var, $propertyName)) {
                $propertyName = $this->resolveIncrementPropertyName($originalPropertyName, $count);
                return $this->resolveNewPropertyNameWhenExists($class, $originalPropertyName, $propertyName, $count);
            }
        }

        $property = $class->getProperty($propertyName);
        if (! $property instanceof Property) {
            return $propertyName;
        }

        $propertyName = $this->resolveIncrementPropertyName($originalPropertyName, $count);
        return $this->resolveNewPropertyNameWhenExists($class, $originalPropertyName, $propertyName, $count);
    }

    private function resolveIncrementPropertyName(string $originalPropertyName, int $count): string
    {
        ++$count;
        return $originalPropertyName . $count;
    }
}
