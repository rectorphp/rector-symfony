<?php

declare(strict_types=1);

namespace Rector\Symfony\TypeAnalyzer;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class ControllerAnalyzer
{
    public function detect(Node $node): bool
    {
        $scope = $node->getAttribute(AttributeKey::SCOPE);

        // might be missing in a trait
        if (! $scope instanceof Scope) {
            return false;
        }

        $classReflection = $scope->getClassReflection();
        if (! $classReflection instanceof ClassReflection) {
            return false;
        }

        if ($classReflection->isSubclassOf('Symfony\Bundle\FrameworkBundle\Controller\Controller')) {
            return true;
        }

        return $classReflection->isSubclassOf('Symfony\Bundle\FrameworkBundle\Controller\AbstractController');
    }
}
