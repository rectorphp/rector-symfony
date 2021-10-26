<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\NodeCollector\ScopeResolver\ParentClassScopeResolver;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class ControllerMethodAnalyzer
{
    public function __construct(
        private ParentClassScopeResolver $parentClassScopeResolver
    ) {
    }

    /**
     * Detect if is <some>Action() in Controller
     */
    public function isAction(Node $node): bool
    {
        if (! $node instanceof ClassMethod) {
            return false;
        }

        $scope = $node->getAttribute(AttributeKey::SCOPE);

        $parentClassName = (string) $this->parentClassScopeResolver->resolveParentClassName($scope);
        if (\str_ends_with($parentClassName, 'Controller')) {
            return true;
        }

        if (\str_ends_with((string) $node->name, 'Action')) {
            return true;
        }

        return $node->isPublic();
    }
}
