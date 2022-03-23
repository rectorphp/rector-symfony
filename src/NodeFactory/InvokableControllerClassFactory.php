<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory;

use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\ValueObject\MethodName;

final class InvokableControllerClassFactory
{
    public function createWithActionClassMethod(
        Class_ $class,
        ClassMethod $actionClassMethod,
        string $controllerName
    ): Class_ {
        $actionClassMethod->name = new Identifier(MethodName::INVOKE);

        $newClass = clone $class;

        $newClassStmts = [];
        foreach ($class->stmts as $classStmt) {
            if (! $classStmt instanceof ClassMethod) {
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
}
