<?php

declare(strict_types=1);

namespace Rector\Symfony\Bridge\NodeAnalyzer;

use PhpParser\Node\Stmt\ClassMethod;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;

final readonly class ControllerMethodAnalyzer
{
    public function __construct(
        private ControllerAnalyzer $controllerAnalyzer
    ) {
    }

    /**
     * Detect if is <some>Action() in Controller
     */
    public function isAction(ClassMethod $classMethod): bool
    {
        if (! $this->controllerAnalyzer->isInsideController($classMethod)) {
            return false;
        }

        return $classMethod->isPublic() && ! $classMethod->isStatic();
    }
}
