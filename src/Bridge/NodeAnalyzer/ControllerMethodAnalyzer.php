<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use Rector\NodeTypeResolver\Node\AttributeKey;
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

        $scope = $node->getAttribute(AttributeKey::SCOPE);
        if (! $scope instanceof Scope) {
            return false;
        }

        if (! $this->controllerAnalyzer->isInsideController($node)) {
            return false;
        }

        return $node->isPublic() && ! $node->isStatic();
    }
}
