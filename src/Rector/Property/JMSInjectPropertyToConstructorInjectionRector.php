<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTagRemover;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\DependencyInjection\TypeAnalyzer\JMSDITypeResolver;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Can cover these cases:
 * - https://jmsyst.com/bundles/JMSDiExtraBundle/master/annotations
 * - https://github.com/rectorphp/rector/issues/700#issue-370301169
 *
 * @see \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\JMSInjectPropertyToConstructorInjectionRectorTest
 */
final class JMSInjectPropertyToConstructorInjectionRector extends AbstractRector
{
    /**
     * @var string
     */
    private const INJECT_ANNOTATION_CLASS = 'JMS\DiExtraBundle\Annotation\Inject';

    /**
     * @var PhpDocTypeChanger
     */
    private $phpDocTypeChanger;

    /**
     * @var PhpDocTagRemover
     */
    private $phpDocTagRemover;

    /**
     * @var JMSDITypeResolver
     */
    private $jmsDITypeResolver;

    public function __construct(
        PhpDocTypeChanger $phpDocTypeChanger,
        PhpDocTagRemover $phpDocTagRemover,
        JMSDITypeResolver $jmsDITypeResolver
    ) {
        $this->phpDocTypeChanger = $phpDocTypeChanger;
        $this->phpDocTagRemover = $phpDocTagRemover;
        $this->jmsDITypeResolver = $jmsDITypeResolver;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns properties with `@inject` to private properties and constructor injection',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
/**
 * @var SomeService
 * @inject
 */
public $someService;
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
/**
 * @var SomeService
 */
private $someService;

public function __construct(SomeService $someService)
{
    $this->someService = $someService;
}
CODE_SAMPLE
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Property::class];
    }

    /**
     * @param Property $node
     */
    public function refactor(Node $node): ?Node
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($node);
        if (! $phpDocInfo instanceof PhpDocInfo) {
            return null;
        }

        $injectTagNode = $phpDocInfo->getByAnnotationClass(self::INJECT_ANNOTATION_CLASS);
        if (! $injectTagNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }

        $serviceType = $this->resolveServiceType($injectTagNode, $phpDocInfo, $node);
        if ($serviceType instanceof MixedType) {
            return null;
        }

        $this->refactorPropertyWithAnnotation($node, $serviceType, $injectTagNode);

        if ($this->isAtLeastPhpVersion(PhpVersionFeature::PROPERTY_PROMOTION)) {
            $this->removeNode($node);
            return null;
        }

        return $node;
    }

    /**
     * @generic extract to core
     */
    private function refactorPropertyWithAnnotation(
        Property $property,
        Type $type,
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ): void {
        $propertyName = $this->getName($property);
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $this->phpDocTypeChanger->changeVarType($phpDocInfo, $type);
        $this->phpDocTagRemover->removeTagValueFromNode($phpDocInfo, $doctrineAnnotationTagValueNode);

        $classLike = $property->getAttribute(AttributeKey::CLASS_NODE);
        if (! $classLike instanceof Class_) {
            throw new ShouldNotHappenException();
        }

        $this->addConstructorDependencyToClass($classLike, $type, $propertyName, $property->flags);
    }

    private function resolveServiceType(
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode,
        PhpDocInfo $phpDocInfo,
        Property $property
    ): Type {
        $serviceType = new MixedType();
        if ($doctrineAnnotationTagValueNode !== null) {
            $serviceType = $phpDocInfo->getVarType();
        }

        if (! $serviceType instanceof MixedType) {
            return $serviceType;
        }

        return $this->jmsDITypeResolver->resolve($property, $doctrineAnnotationTagValueNode);
    }
}
