<?php

declare(strict_types=1);

namespace Rector\Symfony\Annotation;

use PhpParser\Node\Stmt\Class_;
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

        foreach ($class->getMethods() as $classMethod) {
            if ($this->attrinationFinder->hasByOne($classMethod, SymfonyAnnotation::TEMPLATE)) {
                return true;
            }
        }

        return false;
    }
}
