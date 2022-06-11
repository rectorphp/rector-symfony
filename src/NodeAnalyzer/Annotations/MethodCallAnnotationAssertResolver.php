<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\Annotations;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Expression;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\NodeFactory\Annotations\DoctrineAnnotationFromNewFactory;
use Rector\Symfony\ValueObject\ClassMethodAndAnnotation;

final class MethodCallAnnotationAssertResolver
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly ValueResolver $valueResolver,
        private readonly DoctrineAnnotationFromNewFactory $doctrineAnnotationFromNewFactory,
    ) {
    }

    public function resolve(Stmt $stmt): ?ClassMethodAndAnnotation
    {
        if (! $stmt instanceof Expression) {
            return null;
        }

        if (! $stmt->expr instanceof MethodCall) {
            return null;
        }

        $methodCall = $stmt->expr;
        if (! $this->nodeNameResolver->isName($methodCall->name, 'addGetterConstraint')) {
            return null;
        }

        $args = $methodCall->getArgs();
        $firstArgValue = $args[0]->value;

        $propertyName = $this->valueResolver->getValue($firstArgValue);
        $getterMethodName = 'get' . ucfirst($propertyName);

        $secondArgValue = $args[1]->value;
        if (! $secondArgValue instanceof New_) {
            // nothing we can do... or can we?
            return null;
        }

        $doctrineAnnotationTagValueNode = $this->doctrineAnnotationFromNewFactory->create($secondArgValue);
        return new ClassMethodAndAnnotation($getterMethodName, $doctrineAnnotationTagValueNode);
    }
}
