<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\Annotations;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\NodeFactory\Annotations\DoctrineAnnotationFromNewFactory;

final class ConstraintAnnotationResolver
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly ValueResolver $valueResolver,
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly DoctrineAnnotationFromNewFactory $doctrineAnnotationFromNewFactory,
    ) {
    }

    /**
     * @return array<string, DoctrineAnnotationTagValueNode>
     */
    public function resolvePropertyTagValueNodes(ClassMethod $classMethod): array
    {
        $constraintsMethodCalls = $this->findMethodCallsByName($classMethod, 'addPropertyConstraint');

        $annotationsToPropertyNames = [];

        foreach ($constraintsMethodCalls as $constraintMethodCall) {
            $args = $constraintMethodCall->getArgs();

            $constraintsExpr = $args[1]->value;

            $propertyName = $this->valueResolver->getValue($args[0]->value);
            if (! is_string($propertyName)) {
                continue;
            }

            if (! $constraintsExpr instanceof New_) {
                // nothing we can do... or can we?
                continue;
            }

            $assertTagValueNode = $this->doctrineAnnotationFromNewFactory->create($constraintsExpr);
            $annotationsToPropertyNames[$propertyName] = $assertTagValueNode;
        }

        return $annotationsToPropertyNames;
    }

    /**
     * @return array<string, DoctrineAnnotationTagValueNode>
     */
    public function resolveGetterTagValueNodes(ClassMethod $classMethod): array
    {
        $constraintsMethodCalls = $this->findMethodCallsByName($classMethod, 'addGetterConstraint');

        $annotationsToMethodNames = [];

        foreach ($constraintsMethodCalls as $constraintMethodCall) {
            $args = $constraintMethodCall->getArgs();
            $firstArgValue = $args[0]->value;

            $propertyName = $this->valueResolver->getValue($firstArgValue);
            $getterMethodName = 'get' . ucfirst($propertyName);

            $secondArgValue = $args[1]->value;
            if (! $secondArgValue instanceof New_) {
                // nothing we can do... or can we?
                continue;
            }

            $assertTagValueNode = $this->doctrineAnnotationFromNewFactory->create($secondArgValue);
            $annotationsToMethodNames[$getterMethodName] = $assertTagValueNode;
        }

        return $annotationsToMethodNames;
    }

    /**
     * @return MethodCall[]
     */
    private function findMethodCallsByName(ClassMethod $classMethod, string $methodName): array
    {
        $methodCalls = $this->betterNodeFinder->findInstanceOf($classMethod, MethodCall::class);

        return array_filter(
            $methodCalls,
            fn (MethodCall $methodCall): bool => $this->nodeNameResolver->isName($methodCall->name, $methodName)
        );
    }
}
