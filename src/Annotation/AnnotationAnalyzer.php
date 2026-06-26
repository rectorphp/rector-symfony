<?php

declare(strict_types=1);

namespace Rector\Symfony\Annotation;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Doctrine\NodeAnalyzer\AttrinationFinder;
use Rector\Symfony\Enum\SymfonyAnnotation;

final readonly class AnnotationAnalyzer
{
    public function __construct(
        private AttrinationFinder $attrinationFinder
    ) {
    }

    public function hasClassMethodWithTemplateAnnotation(Class_ $class): bool
    {
        if ($this->attrinationFinder->hasByOne($class, SymfonyAnnotation::TEMPLATE)) {
            return true;
        }
        return array_any(
            $class->getMethods(),
            fn (ClassMethod $classMethod): bool => $this->attrinationFinder->hasByOne(
                $classMethod,
                SymfonyAnnotation::TEMPLATE
            )
        );
    }
}
