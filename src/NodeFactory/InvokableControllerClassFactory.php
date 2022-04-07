<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory;

use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Property;
use Rector\Core\ValueObject\MethodName;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\NodeAnalyzer\InvokableAnalyzer\ActiveClassElementsClassMethodResolver;
use Rector\Symfony\ValueObject\InvokableController\ActiveClassElements;

final class InvokableControllerClassFactory
{
    public function __construct(
        private readonly InvokableControllerNameFactory $invokableControllerNameFactory,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly ActiveClassElementsClassMethodResolver $activeClassElementsClassMethodResolver,
    ) {
    }

    public function createWithActionClassMethod(Class_ $class, ClassMethod $actionClassMethod): Class_
    {
        $controllerName = $this->createControllerName($class, $actionClassMethod);

        $actionClassMethod->name = new Identifier(MethodName::INVOKE);

        $newClass = clone $class;

        $newClassStmts = $this->resolveNewClassStmts($actionClassMethod, $class);

        $newClass->name = new Identifier($controllerName);
        $newClass->stmts = $newClassStmts;

        return $newClass;
    }

    private function createControllerName(Class_ $class, ClassMethod $actionClassMethod): string
    {
        /** @var Identifier $className */
        $className = $class->name;

        return $this->invokableControllerNameFactory->createControllerName(
            $className,
            $actionClassMethod->name->toString()
        );
    }

    private function filterOutUnusedDependencies(
        ClassMethod $classMethod,
        ActiveClassElements $activeClassElements
    ): ClassMethod {
        // to keep original method in other run untouched
        $classMethod = clone $classMethod;

        foreach ($classMethod->params as $key => $param) {
            $paramName = $this->nodeNameResolver->getName($param);
            if (! $activeClassElements->hasPropertyName($paramName)) {
                unset($classMethod->params[$key]);
            }
        }

        $this->filterOutUnusedPropertyAssigns($classMethod, $activeClassElements);

        return $classMethod;
    }

    private function filterOutUnusedPropertyAssigns(
        ClassMethod $classMethod,
        ActiveClassElements $activeClassElements
    ): void {
        if (! is_array($classMethod->stmts)) {
            return;
        }

        foreach ($classMethod->stmts as $key => $stmt) {
            if (! $stmt instanceof Expression) {
                continue;
            }

            $stmtExpr = $stmt->expr;
            if (! $stmtExpr instanceof Assign) {
                continue;
            }

            if (! $stmtExpr->var instanceof PropertyFetch) {
                continue;
            }

            $assignPropertyFetch = $stmtExpr->var;
            $propertyFetchName = $this->nodeNameResolver->getName($assignPropertyFetch->name);
            if (! is_string($propertyFetchName)) {
                continue;
            }

            if ($activeClassElements->hasPropertyName($propertyFetchName)) {
                continue;
            }

            unset($classMethod->stmts[$key]);
        }
    }

    /**
     * @return Stmt[]
     */
    private function resolveNewClassStmts(ClassMethod $actionClassMethod, Class_ $class): array
    {
        $activeClassElements = $this->activeClassElementsClassMethodResolver->resolve($actionClassMethod);

        // @todo filter out later
        $newClassStmts = $class->getConstants();

        $activeProperties = $this->filterProperties($class, $activeClassElements);
        $newClassStmts = array_merge($newClassStmts, $activeProperties);

        foreach ($class->getMethods() as $classMethod) {
            // avoid duplicated names
            if ($classMethod->isMagic() && ! $this->nodeNameResolver->isName($classMethod->name, MethodName::INVOKE)) {
                if ($this->nodeNameResolver->isName($classMethod->name, MethodName::CONSTRUCT)) {
                    $classMethod = $this->filterOutUnusedDependencies($classMethod, $activeClassElements);
                }

                $newClassStmts[] = $classMethod;
                continue;
            }

            // @todo filter out only used private methods later
            if (! $classMethod->isPublic()) {
                $newClassStmts[] = $classMethod;
            }
        }

        $newClassStmts[] = $actionClassMethod;

        return $newClassStmts;
    }

    /**
     * @return Property[]
     */
    private function filterProperties(Class_ $class, ActiveClassElements $activeClassElements): array
    {
        return array_filter($class->getProperties(), function (Property $property) use ($activeClassElements) {
            // keep only property used in current action
            $propertyName = $this->nodeNameResolver->getName($property);
            return $activeClassElements->hasPropertyName($propertyName);
        });
    }
}
