<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Type\ObjectType;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\PhpParser\Node\NodeFactory;
use Rector\Naming\Naming\PropertyNaming;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\PostRector\DependencyInjection\PropertyAdder;

final class DependencyInjectionMethodCallAnalyzer
{
    public function __construct(
        private PropertyNaming $propertyNaming,
        private ServiceTypeMethodCallResolver $serviceTypeMethodCallResolver,
        private NodeFactory $nodeFactory,
        private PropertyAdder $propertyAdder
    ) {
    }

    public function replaceMethodCallWithPropertyFetchAndDependency(MethodCall $methodCall): ?Node
    {
        $serviceType = $this->serviceTypeMethodCallResolver->resolve($methodCall);
        if (! $serviceType instanceof ObjectType) {
            return null;
        }

        $classLike = $methodCall->getAttribute(AttributeKey::CLASS_NODE);
        if (! $classLike instanceof Class_) {
            throw new ShouldNotHappenException();
        }

        $propertyName = $this->propertyNaming->fqnToVariableName($serviceType);
        $this->propertyAdder->addConstructorDependencyToClass($classLike, $serviceType, $propertyName);

        return $this->nodeFactory->createPropertyFetch('this', $propertyName);
    }
}
