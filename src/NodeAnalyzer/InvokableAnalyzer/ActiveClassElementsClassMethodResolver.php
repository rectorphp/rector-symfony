<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\InvokableAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\ValueObject\InvokableController\ActiveClassElements;
use Symplify\Astral\NodeTraverser\SimpleCallableNodeTraverser;

final class ActiveClassElementsClassMethodResolver
{
    public function __construct(
        private readonly SimpleCallableNodeTraverser $simpleCallableNodeTraverser,
        private readonly NodeNameResolver $nodeNameResolver,
    ) {
    }

    public function resolve(ClassMethod $actionClassMethod): ActiveClassElements
    {
        $usedLocalPropertyNames = $this->resolveLocalUsedPropertyNames($actionClassMethod);
        $usedLocalConstantNames = $this->resolveLocalUsedConstantNames($actionClassMethod);
        $usedLocalMethodNames = $this->resolveLocalUsedMethodNames($actionClassMethod);

        return new ActiveClassElements($usedLocalPropertyNames, $usedLocalConstantNames, $usedLocalMethodNames);
    }

    /**
     * @return string[]
     */
    private function resolveLocalUsedPropertyNames(ClassMethod $actionClassMethod): array
    {
        $usedLocalPropertyNames = [];

        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($actionClassMethod, function (Node $node) use (
            &$usedLocalPropertyNames
        ) {
            if (! $node instanceof PropertyFetch) {
                return null;
            }

            if (! $this->nodeNameResolver->isName($node->var, 'this')) {
                return null;
            }

            $propertyName = $this->nodeNameResolver->getName($node->name);
            if (! is_string($propertyName)) {
                return null;
            }

            $usedLocalPropertyNames[] = $propertyName;
        });

        return $usedLocalPropertyNames;
    }

    /**
     * @return string[]
     */
    private function resolveLocalUsedConstantNames(ClassMethod $actionClassMethod): array
    {
        $usedLocalConstantNames = [];

        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($actionClassMethod, function (Node $node) use (
            &$usedLocalConstantNames
        ) {
            if (! $node instanceof ClassConstFetch) {
                return null;
            }

            if (! $this->nodeNameResolver->isName($node->class, 'self')) {
                return null;
            }

            $constantName = $this->nodeNameResolver->getName($node->name);
            if (! is_string($constantName)) {
                return null;
            }

            $usedLocalConstantNames[] = $constantName;
        });

        return $usedLocalConstantNames;
    }

    /**
     * @return string[]
     */
    private function resolveLocalUsedMethodNames(ClassMethod $actionClassMethod): array
    {
        $usedLocalMethodNames = [];

        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($actionClassMethod, function (Node $node) use (
            &$usedLocalMethodNames
        ) {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $this->nodeNameResolver->isName($node->var, 'this')) {
                return null;
            }

            $methodName = $this->nodeNameResolver->getName($node->name);
            if (! is_string($methodName)) {
                return null;
            }

            $usedLocalMethodNames[] = $methodName;
        });

        return $usedLocalMethodNames;
    }
}
