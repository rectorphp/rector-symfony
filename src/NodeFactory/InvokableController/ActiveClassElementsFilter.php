<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory\InvokableController;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\ValueObject\InvokableController\ActiveClassElements;

final class ActiveClassElementsFilter
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver,
    ) {
    }

    /**
     * @return ClassConst[]
     */
    public function filterClassConsts(Class_ $class, ActiveClassElements $activeClassElements): array
    {
        return array_filter(
            $class->getConstants(),
            function (ClassConst $classConst) use ($activeClassElements) {
                /** @var string $constantName */
                $constantName = $this->nodeNameResolver->getName($classConst);
                return $activeClassElements->hasConstantName($constantName);
            }
        );
    }

    /**
     * @return Property[]
     */
    public function filterProperties(Class_ $class, ActiveClassElements $activeClassElements): array
    {
        return array_filter(
            $class->getProperties(),
            function (Property $property) use ($activeClassElements) {
                // keep only property used in current action
                $propertyName = $this->nodeNameResolver->getName($property);
                return $activeClassElements->hasPropertyName($propertyName);
            }
        );
    }

    /**
     * @return ClassMethod[]
     */
    public function filterClassMethod(Class_ $class, ActiveClassElements $activeClassElements): array
    {
        return array_filter(
            $class->getMethods(),
            function (ClassMethod $classMethod) use ($activeClassElements) {
                if ($classMethod->isPublic()) {
                    return false;
                }

                /** @var string $classMethodName */
                $classMethodName = $this->nodeNameResolver->getName($classMethod->name);
                return $activeClassElements->hasMethodName($classMethodName);
            }
        );
    }
}
