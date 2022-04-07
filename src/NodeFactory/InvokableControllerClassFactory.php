<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory;

use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\Core\ValueObject\MethodName;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\NodeAnalyzer\InvokableAnalyzer\ActiveClassElementsClassMethodResolver;

final class InvokableControllerClassFactory
{
    public function __construct(
        private readonly InvokableControllerNameFactory $invokableControllerNameFactory,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly ActiveClassElementsClassMethodResolver $activeClassElementsClassMethodResolver,
    ) {
    }

    public function createWithActionClassMethod(Class_ $class, ClassMethod $actionClassMethod): Class_
    {
        $controllerName = $this->createControllerName($class, $actionClassMethod);

        $actionClassMethod->name = new Identifier(MethodName::INVOKE);

        $newClass = clone $class;

        $newClassStmts = [];

        $activeClassElements = $this->activeClassElementsClassMethodResolver->resolve($actionClassMethod);

        foreach ($class->stmts as $classStmt) {
            // keep only elements used in current actoin
            if ($classStmt instanceof Property) {
                if ($activeClassElements->hasProperty($classStmt)) {
                    $newClassStmts[] = $classStmt;
                }

                continue;
            }

            if (! $classStmt instanceof ClassMethod) {
                $newClassStmts[] = $classStmt;
                continue;
            }

            // avoid duplicated names
            if ($classStmt->isMagic() && ! $this->nodeNameResolver->isName($classStmt->name, MethodName::INVOKE)) {
                $newClassStmts[] = $classStmt;
                continue;
            }

            if (! $classStmt->isPublic()) {
                $newClassStmts[] = $classStmt;
            }
        }

        $newClassStmts[] = $actionClassMethod;

        $newClass->name = new Identifier($controllerName);

        $newClass->stmts = $newClassStmts;

        return $newClass;
    }

    private function createControllerName(Class_ $class, ClassMethod $actionClassMethod): string
    {
        /** @var Identifier $className */
        $className = $class->name;

        return $this->invokableControllerNameFactory->createControllerName(
            $className,
            $actionClassMethod->name->toString()
        );
    }
}
