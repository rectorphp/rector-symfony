<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Type\ObjectType;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\Node\NodeFactory;
use Rector\Naming\Naming\PropertyNaming;
use Rector\PostRector\Collector\PropertyToAddCollector;
use Rector\PostRector\ValueObject\PropertyMetadata;

final class DependencyInjectionMethodCallAnalyzer
{
    public function __construct(
        private PropertyNaming $propertyNaming,
        private ServiceTypeMethodCallResolver $serviceTypeMethodCallResolver,
        private NodeFactory $nodeFactory,
        private PropertyToAddCollector $propertyToAddCollector,
        private BetterNodeFinder $betterNodeFinder,
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

        $propertyMetadata = new PropertyMetadata($propertyName, $serviceType, Class_::MODIFIER_PRIVATE);
        $this->propertyToAddCollector->addPropertyToClass($class, $propertyMetadata);

        return $this->nodeFactory->createPropertyFetch('this', $propertyName);
    }
}
