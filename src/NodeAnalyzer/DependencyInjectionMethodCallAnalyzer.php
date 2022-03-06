<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\ObjectType;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\Node\NodeFactory;
use Rector\Naming\Naming\PropertyNaming;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Php80\NodeAnalyzer\PromotedPropertyResolver;
use Rector\PostRector\Collector\PropertyToAddCollector;
use Rector\PostRector\ValueObject\PropertyMetadata;

final class DependencyInjectionMethodCallAnalyzer
{
    public function __construct(
        private readonly PropertyNaming $propertyNaming,
        private readonly ServiceTypeMethodCallResolver $serviceTypeMethodCallResolver,
        private readonly NodeFactory $nodeFactory,
        private readonly PropertyToAddCollector $propertyToAddCollector,
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly PromotedPropertyResolver $promotedPropertyResolver,
        private readonly NodeNameResolver $nodeNameResolver
    ) {
    }

    public function replaceMethodCallWithPropertyFetchAndDependency(MethodCall $methodCall): ?PropertyFetch
    {
        $serviceType = $this->serviceTypeMethodCallResolver->resolve($methodCall);
        if (! $serviceType instanceof ObjectType) {
            return null;
        }

        $class = $this->betterNodeFinder->findParentType($methodCall, Class_::class);
        if (! $class instanceof Class_) {
            return null;
        }

        $propertyName = $this->propertyNaming->fqnToVariableName($serviceType);
        $propertyName = $this->resolveNewPropertyNameWhenExists($class, $propertyName, $propertyName);

        $propertyMetadata = new PropertyMetadata($propertyName, $serviceType, Class_::MODIFIER_PRIVATE);
        $this->propertyToAddCollector->addPropertyToClass($class, $propertyMetadata);

        return $this->nodeFactory->createPropertyFetch('this', $propertyName);
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
