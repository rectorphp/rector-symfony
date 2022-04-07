<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\InvokableAnalyzer;

use PhpParser\Node;
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

        return new ActiveClassElements($usedLocalPropertyNames);
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
}
