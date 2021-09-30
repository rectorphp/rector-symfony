<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\NodeCollector\ScopeResolver\ParentClassScopeResolver;

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

        $parentClassName = (string) $this->parentClassScopeResolver->resolveParentClassName($node);
        if (\str_ends_with($parentClassName, 'Controller')) {
            return true;
        }

        if (\str_ends_with((string) $node->name, 'Action')) {
            return true;
        }

        return $node->isPublic();
    }
}
