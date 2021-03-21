<?php

declare(strict_types=1);

namespace Rector\Symfony\PhpDoc\NodeFactory;

use Doctrine\ORM\Mapping\Annotation;
use PhpParser\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use Rector\BetterPhpDocParser\Contract\MultiPhpDocNodeFactoryInterface;
use Rector\BetterPhpDocParser\Contract\PhpDocNodeFactoryInterface;
use Rector\BetterPhpDocParser\PhpDocNodeFactory\AbstractPhpDocNodeFactory;
use Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter;
use Rector\BetterPhpDocParser\Printer\TagValueNodePrinter;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;
use Rector\Symfony\PhpDoc\Node\AssertChoiceTagValueNode;
use Rector\Symfony\PhpDoc\Node\AssertEmailTagValueNode;
use Rector\Symfony\PhpDoc\Node\AssertRangeTagValueNode;
use Rector\Symfony\PhpDoc\Node\AssertTypeTagValueNode;
use Rector\Symfony\PhpDoc\Node\JMS\JMSInjectParamsTagValueNode;
use Rector\Symfony\PhpDoc\Node\JMS\JMSServiceTagValueNode;
use Rector\Symfony\PhpDoc\Node\JMS\SerializerTypeTagValueNode;
use Rector\Symfony\PhpDoc\Node\Sensio\SensioMethodTagValueNode;
use Rector\Symfony\PhpDoc\Node\Sensio\SensioRouteTagValueNode;
use Rector\Symfony\PhpDoc\Node\Sensio\SensioTemplateTagValueNode;
use Rector\Symfony\PhpDoc\Node\SymfonyRouteTagValueNode;

final class MultiPhpDocNodeFactory extends AbstractPhpDocNodeFactory implements PhpDocNodeFactoryInterface, MultiPhpDocNodeFactoryInterface
{
    /**
     * @var ArrayPartPhpDocTagPrinter
     */
    private $arrayPartPhpDocTagPrinter;

    /**
     * @var TagValueNodePrinter
     */
    private $tagValueNodePrinter;

    public function __construct(
        ArrayPartPhpDocTagPrinter $arrayPartPhpDocTagPrinter,
        TagValueNodePrinter $tagValueNodePrinter
    ) {
        $this->arrayPartPhpDocTagPrinter = $arrayPartPhpDocTagPrinter;
        $this->tagValueNodePrinter = $tagValueNodePrinter;
    }

    /**
     * @return array<class-string<AbstractTagValueNode>, class-string<Annotation>>
     */
    public function getTagValueNodeClassesToAnnotationClasses(): array
    {
        return [
            // tag value node class => annotation class

            // symfony/http-kernel
            SymfonyRouteTagValueNode::class => 'Symfony\Component\Routing\Annotation\Route',
            // symfony/validator
            AssertRangeTagValueNode::class => 'Symfony\Component\Validator\Constraints\Range',
            AssertTypeTagValueNode::class => 'Symfony\Component\Validator\Constraints\Type',
            AssertChoiceTagValueNode::class => 'Symfony\Component\Validator\Constraints\Choice',
            AssertEmailTagValueNode::class => 'Symfony\Component\Validator\Constraints\Email',

            // Sensio
            SensioTemplateTagValueNode::class => 'Sensio\Bundle\FrameworkExtraBundle\Configuration\Template',
            SensioMethodTagValueNode::class => 'Sensio\Bundle\FrameworkExtraBundle\Configuration\Method',
            SensioRouteTagValueNode::class => 'Sensio\Bundle\FrameworkExtraBundle\Configuration\Route',

            // JMS
            JMSInjectParamsTagValueNode::class => 'JMS\DiExtraBundle\Annotation\InjectParams',
            JMSServiceTagValueNode::class => 'JMS\DiExtraBundle\Annotation\Service',
            SerializerTypeTagValueNode::class => 'JMS\Serializer\Annotation\Type',
        ];
    }

    public function createFromNodeAndTokens(
        Node $node,
        TokenIterator $tokenIterator,
        string $annotationClass
    ): ?PhpDocTagValueNode {
        $annotation = $this->nodeAnnotationReader->readAnnotation($node, $annotationClass);
        if ($annotation === null) {
            return null;
        }

        $tagValueNodeClassesToAnnotationClasses = $this->getTagValueNodeClassesToAnnotationClasses();
        $tagValueNodeClass = array_search($annotationClass, $tagValueNodeClassesToAnnotationClasses, true);
        if ($tagValueNodeClass === false) {
            return null;
        }

        $items = $this->annotationItemsResolver->resolve($annotation);
        $content = $this->annotationContentResolver->resolveFromTokenIterator($tokenIterator);

        return new $tagValueNodeClass(
            $this->arrayPartPhpDocTagPrinter,
            $this->tagValueNodePrinter,
            $items,
            $content
        );
    }
}
