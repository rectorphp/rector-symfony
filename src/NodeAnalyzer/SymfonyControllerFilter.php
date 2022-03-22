<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;

final class SymfonyControllerFilter
{
    /**
     * @return ClassMethod[]
     */
    public function filterActionMethods(Class_ $class): array
    {
        $actionClassMethods = [];

        foreach ($class->getMethods() as $classMethod) {
            if (! $classMethod->isPublic()) {
                continue;
            }

            $actionClassMethods[] = $classMethod;
        }

        return $actionClassMethods;
    }
}
