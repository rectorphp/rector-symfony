<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\Command;

use PhpParser\Node;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use PHPStan\Type\ObjectType;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer;
use Rector\PhpDocParser\NodeTraverser\SimpleCallableNodeTraverser;
use Rector\Symfony\Enum\SymfonyAnnotation;

final class SetAliasesMethodCallExtractor
{
    public function __construct(
        private readonly PhpAttributeAnalyzer $phpAttributeAnalyzer,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly NodeTypeResolver $nodeTypeResolver,
        private readonly SimpleCallableNodeTraverser $simpleCallableNodeTraverser,
        private readonly AttributeValueResolver $attributeValueResolver,
    ) {
    }

    public function resolveCommandAliasesFromAttributeOrSetter(Class_ $class): ?Array_
    {
        $classMethod = $class->getMethod('configure');
        if (! $classMethod instanceof ClassMethod) {
            return $this->resolveCommandAliasesFromAttribute($class);
        }

        if ($classMethod->stmts === null) {
            return null;
        }

        $aliasesArray = $this->resolveFromStmtSetterMethodCall($classMethod);
        if ($aliasesArray instanceof Array_) {
            return $aliasesArray;
        }

        $aliasesArray = null;

        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($classMethod, function (Node $node) use (
            &$aliasesArray
        ) {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $this->isSetAliasesMethodCall($node)) {
                return null;
            }

            $firstArgValue = $node->getArgs()[0]
                ->value;
            if (! $firstArgValue instanceof Array_) {
                return null;
            }

            $aliasesArray = $firstArgValue;

            return $node->var;
        });

        return $aliasesArray;
    }

    private function resolveCommandAliasesFromAttribute(Class_ $class): ?Array_
    {
        if (! $this->phpAttributeAnalyzer->hasPhpAttribute($class, SymfonyAnnotation::AS_COMMAND)) {
            return null;
        }

        $commandAliasesFromArgument = $this->attributeValueResolver->getArgumentValueFromAttribute($class, 2);
        if ($commandAliasesFromArgument instanceof Array_) {
            return $commandAliasesFromArgument;
        }

        return null;
    }

    private function resolveFromStmtSetterMethodCall(ClassMethod $classMethod): Array_|null
    {
        if ($classMethod->stmts === null) {
            return null;
        }

        foreach ($classMethod->stmts as $key => $stmt) {
            if (! $stmt instanceof Expression) {
                continue;
            }

            if (! $stmt->expr instanceof MethodCall) {
                continue;
            }

            $methodCall = $stmt->expr;
            if (! $this->isSetAliasesMethodCall($methodCall)) {
                continue;
            }

            $arg = $methodCall->getArgs()[0];
            if (! $arg->value instanceof Array_) {
                return null;
            }

            unset($classMethod->stmts[$key]);
            return $arg->value;
        }

        return null;
    }

    private function isSetAliasesMethodCall(MethodCall $methodCall): bool
    {
        if (! $this->nodeNameResolver->isName($methodCall->name, 'setAliases')) {
            return false;
        }

        return $this->nodeTypeResolver->isObjectType(
            $methodCall->var,
            new ObjectType('Symfony\Component\Console\Command\Command')
        );
    }
}
