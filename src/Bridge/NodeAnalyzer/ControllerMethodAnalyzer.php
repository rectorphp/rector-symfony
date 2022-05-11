<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;

final class ControllerMethodAnalyzer
{
    public function __construct(
        private readonly ControllerAnalyzer $controllerAnalyzer
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

        if (! $this->controllerAnalyzer->isInsideController($node)) {
            return false;
        }

        return $node->isPublic() && ! $node->isStatic();
    }
}
