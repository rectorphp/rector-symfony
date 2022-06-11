<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\NodeAnalyzer\Annotations\MethodCallAnnotationAssertResolver;
use Rector\Symfony\NodeAnalyzer\Annotations\PropertyAnnotationAssertResolver;
use Rector\Symfony\ValueObject\ClassMethodAndAnnotation;
use Rector\Symfony\ValueObject\PropertyAndAnnotation;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://symfony.com/doc/current/components/validator/metadata.html
 * @changelog https://symfony.com/doc/current/validation.html#the-basics-of-validation
 *
 * @see \Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\LoadValidatorMetadataToAnnotationRectorTest
 */
final class LoadValidatorMetadataToAnnotationRector extends AbstractRector
{
    public function __construct(
        private readonly MethodCallAnnotationAssertResolver $methodCallAnnotationAssertResolver,
        private readonly PropertyAnnotationAssertResolver $propertyAnnotationAssertResolver
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Move metadata from loadValidatorMetadata() to property/getter/method annotations', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SomeClass
{
    private $city;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('city', new Assert\NotBlank([
            'message' => 'City can\'t be blank.',
        ]));
    }
}
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SomeClass
{
    /**
     * @Assert\NotBlank(message="City can't be blank.")
     */
    private $city;
}
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        $loadValidatorMetadataClassMethod = $node->getMethod('loadValidatorMetadata');
        if (! $loadValidatorMetadataClassMethod instanceof ClassMethod) {
            return null;
        }

        foreach ((array) $loadValidatorMetadataClassMethod->stmts as $stmtKey => $classStmt) {
            $classMethodAndAnnotation = $this->methodCallAnnotationAssertResolver->resolve($classStmt);
            if ($classMethodAndAnnotation instanceof ClassMethodAndAnnotation) {
                $this->refactorClassMethodAndAnnotation(
                    $node,
                    $classMethodAndAnnotation,
                    $loadValidatorMetadataClassMethod,
                    $stmtKey
                );
            }

            $propertyAndAnnotation = $this->propertyAnnotationAssertResolver->resolve($classStmt);
            if ($propertyAndAnnotation instanceof PropertyAndAnnotation) {
                $this->refactorPropertyAndAnnotation(
                    $node,
                    $propertyAndAnnotation,
                    $loadValidatorMetadataClassMethod,
                    $stmtKey
                );
            }
        }

        // remove empty class method
        if ((array) $loadValidatorMetadataClassMethod->stmts === []) {
            $this->removeNode($loadValidatorMetadataClassMethod);
        }

        return $node;
    }

    private function refactorClassMethodAndAnnotation(
        Class_ $class,
        ClassMethodAndAnnotation $classMethodAndAnnotation,
        ClassMethod $loadValidatorMetadataClassMethod,
        int $stmtKey
    ): void {
        $classMethod = $class->getMethod($classMethodAndAnnotation->getMethodName());
        if (! $classMethod instanceof ClassMethod) {
            return;
        }

        $getterPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);
        $getterPhpDocInfo->addTagValueNode($classMethodAndAnnotation->getDoctrineAnnotationTagValueNode());

        unset($loadValidatorMetadataClassMethod->stmts[$stmtKey]);
    }

    private function refactorPropertyAndAnnotation(
        Class_ $class,
        PropertyAndAnnotation $propertyAndAnnotation,
        ClassMethod $loadValidatorMetadataClassMethod,
        int $stmtKey
    ): void {
        $property = $class->getProperty($propertyAndAnnotation->getProperty());
        if (! $property instanceof Property) {
            return;
        }

        $propertyPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        $propertyPhpDocInfo->addTagValueNode($propertyAndAnnotation->getDoctrineAnnotationTagValueNode());

        unset($loadValidatorMetadataClassMethod->stmts[$stmtKey]);
    }
}
