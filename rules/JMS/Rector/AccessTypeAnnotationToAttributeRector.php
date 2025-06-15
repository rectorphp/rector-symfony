<?php

declare(strict_types=1);

namespace Rector\Symfony\JMS\Rector;

use PhpParser\Node\Identifier;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\ArrayItem;
use PhpParser\Node;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Use_;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\Reflection\ReflectionProvider;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTagRemover;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Naming\Naming\UseImportsResolver;
use Rector\Php80\NodeFactory\AttrGroupsFactory;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Php80\ValueObject\DoctrineTagAndAnnotationToAttribute;
use Rector\Rector\AbstractRector;
use Rector\Symfony\Enum\JMSAnnotation;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/schmittjoh/serializer/issues/1531
 *
 * @see \Rector\Symfony\Tests\JMS\Rector\Class_\AccessTypeAnnotationToAttributeRector\AccessTypeAnnotationToAttributeRectorTest
 */
final class AccessTypeAnnotationToAttributeRector extends AbstractRector
{
    private AnnotationToAttribute $annotationToAttribute;

    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly UseImportsResolver $useImportsResolver,
        private readonly DocBlockUpdater $docBlockUpdater,
        private readonly ReflectionProvider $reflectionProvider,
        private readonly AttrGroupsFactory $attrGroupsFactory,
        private readonly PhpDocTagRemover $phpDocTagRemover,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Changes @AccessType annotation to #[AccessType] attribute with specific key',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use JMS\Serializer\Annotation\AccessType;

/** @AccessType("public_method") */
class User
{
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use JMS\Serializer\Annotation\AccessType;

#[AccessType(values: ['public_method'])]
class User
{
}
CODE_SAMPLE
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [Class_::class, Property::class];
    }

    /**
     * @param Class_|Property $node
     */
    public function refactor(Node $node): Class_|Property|null
    {
        $this->annotationToAttribute = new AnnotationToAttribute(JMSAnnotation::ACCESS_TYPE);

        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($node);
        if (! $phpDocInfo instanceof PhpDocInfo) {
            return null;
        }

        $uses = $this->useImportsResolver->resolveBareUses();

        // 1. Doctrine annotation classes
        $attributeGroups = $this->processDoctrineAnnotationClasses($phpDocInfo, $uses);
        if ($attributeGroups === []) {
            return null;
        }

        // 2. Reprint docblock
        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        $node->attrGroups = array_merge($node->attrGroups, $attributeGroups);

        return $node;
    }

    /**
     * @param Use_[] $uses
     * @return AttributeGroup[]
     */
    private function processDoctrineAnnotationClasses(PhpDocInfo $phpDocInfo, array $uses): array
    {
        if ($phpDocInfo->getPhpDocNode()->children === []) {
            return [];
        }

        $doctrineTagAndAnnotationToAttributes = [];
        $doctrineTagValueNodes = [];

        foreach ($phpDocInfo->getPhpDocNode()->children as $phpDocChildNode) {
            if (! $phpDocChildNode instanceof PhpDocTagNode) {
                continue;
            }

            if (! $phpDocChildNode->value instanceof DoctrineAnnotationTagValueNode) {
                continue;
            }

            $doctrineTagValueNode = $phpDocChildNode->value;
            if (! $doctrineTagValueNode->hasClassName(JMSAnnotation::ACCESS_TYPE)) {
                continue;
            }

            if (! $this->isExistingAttributeClass($this->annotationToAttribute)) {
                continue;
            }

            $doctrineTagAndAnnotationToAttributes[] = new DoctrineTagAndAnnotationToAttribute(
                $doctrineTagValueNode,
                $this->annotationToAttribute
            );

            $doctrineTagValueNodes[] = $doctrineTagValueNode;
        }

        $attributeGroups = $this->attrGroupsFactory->create($doctrineTagAndAnnotationToAttributes, $uses);

        // correct to array!
        $attribute = $attributeGroups[0]->attrs[0];

        if (count($attribute->args) === 1) {
            $soleArg = $attribute->args[0];
            // wrap to array
            $soleArg->name = new Identifier('values');
            $soleArg->value = new Array_([new ArrayItem($soleArg->value)]);
        }

        foreach ($doctrineTagValueNodes as $doctrineTagValueNode) {
            $this->phpDocTagRemover->removeTagValueFromNode($phpDocInfo, $doctrineTagValueNode);
        }

        return $attributeGroups;
    }

    private function isExistingAttributeClass(AnnotationToAttribute $annotationToAttribute): bool
    {
        // make sure the attribute class really exists to avoid error on early upgrade
        if (! $this->reflectionProvider->hasClass($annotationToAttribute->getAttributeClass())) {
            return false;
        }

        // make sure the class is marked as attribute
        $classReflection = $this->reflectionProvider->getClass($annotationToAttribute->getAttributeClass());
        return $classReflection->isAttributeClass();
    }
}
