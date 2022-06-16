<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\Annotations;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Stmt;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\NodeFactory\Annotations\DoctrineAnnotationFromNewFactory;
use Rector\Symfony\ValueObject\ValidatorAssert\ClassMethodAndAnnotation;

final class MethodCallAnnotationAssertResolver
{
    public function __construct(
        private readonly ValueResolver $valueResolver,
        private readonly DoctrineAnnotationFromNewFactory $doctrineAnnotationFromNewFactory,
        private readonly StmtMethodCallMatcher $stmtMethodCallMatcher,
    ) {
    }

    public function resolve(Stmt $stmt): ?ClassMethodAndAnnotation
    {
        $methodCall = $this->stmtMethodCallMatcher->match($stmt, 'addGetterConstraint');
        if (! $methodCall instanceof MethodCall) {
            return null;
        }

        $args = $methodCall->getArgs();
        $firstArgValue = $args[0]->value;

        $propertyName = $this->valueResolver->getValue($firstArgValue);

        // based on https://github.com/symfony/symfony/blob/7d4b42cbeef195e0a01272b9c5f464f0afe52542/src/Symfony/Component/Validator/Mapping/GetterMetadata.php#L45-L47
        $possibleMethodNames = [
            'get' . ucfirst($propertyName),
            'is' . ucfirst($propertyName),
            'has' . ucfirst($propertyName),
        ];

        $secondArgValue = $args[1]->value;
        if (! $secondArgValue instanceof New_) {
            // nothing we can do... or can we?
            return null;
        }

        $doctrineAnnotationTagValueNode = $this->doctrineAnnotationFromNewFactory->create($secondArgValue);
        return new ClassMethodAndAnnotation($possibleMethodNames, $doctrineAnnotationTagValueNode);
    }
}
