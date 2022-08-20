<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDocParser\StaticDoctrineAnnotationParser\ArrayParser;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\Contract\Bridge\Symfony\Routing\SymfonyRoutesProviderInterface;
use Rector\Symfony\Enum\SymfonyAnnotation;
use Rector\Symfony\NodeFactory\Annotations\ValueQuoteWrapper;
use Rector\Symfony\PhpDocNode\SymfonyRouteTagValueNodeFactory;
use Rector\Symfony\ValueObject\SymfonyRouteMetadata;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\AddRouteAnnotationRectorTest
 */
final class AddRouteAnnotationRector extends AbstractRector
{
    public function __construct(
        private readonly SymfonyRoutesProviderInterface $symfonyRoutesProvider,
        private readonly SymfonyRouteTagValueNodeFactory $symfonyRouteTagValueNodeFactory,
        private readonly ArrayParser $arrayParser
    ) {
    }

    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        // only public methods can be controller routes
        if (! $node->isPublic()) {
            return null;
        }

        if ($node->isStatic()) {
            return null;
        }

        $class = $this->betterNodeFinder->findParentType($node, Class_::class);
        if (! $class instanceof Class_) {
            return null;
        }

        if ($this->symfonyRoutesProvider->provide() === []) {
            return null;
        }

        $controllerReference = $this->resolveControllerReference($class, $node);

        // is there a route for this annotation?
        $symfonyRouteMetadata = $this->matchSymfonyRouteMetadataByControllerReference($controllerReference);

        if (! $symfonyRouteMetadata instanceof SymfonyRouteMetadata) {
            return null;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);
        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClass(SymfonyAnnotation::ROUTE);

        if ($doctrineAnnotationTagValueNode !== null) {
            return null;
        }

        $items = $this->createRouteItems($symfonyRouteMetadata);
        $symfonyRouteTagValueNode = $this->symfonyRouteTagValueNodeFactory->createFromItems($items);

        $phpDocInfo->addTagValueNode($symfonyRouteTagValueNode);

        return $node;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Collect routes from Symfony project router and add Route annotation to controller action',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeController extends AbstractController
{
    public function index()
    {
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SomeController extends AbstractController
{
    /**
     * @Route(name="homepage", path="/welcome")
     */
    public function index()
    {
    }
}
CODE_SAMPLE
                ),
            ]
        );
    }

    private function resolveControllerReference(Class_ $class, ClassMethod $classMethod): string
    {
        $className = $this->nodeNameResolver->getName($class);
        $methodName = $this->nodeNameResolver->getName($classMethod);

        return $className . '::' . $methodName;
    }

    /**
     * @return ArrayItemNode[]
     */
    private function createRouteItems(SymfonyRouteMetadata $symfonyRouteMetadata): array
    {
        $arrayItemNodes = [];

        $arrayItemNodes[] = new ArrayItemNode(
            $symfonyRouteMetadata->getPath(),
            'path',
            String_::KIND_DOUBLE_QUOTED
        );
        $arrayItemNodes[] = new ArrayItemNode(
            $symfonyRouteMetadata->getName(),
            'name',
            String_::KIND_DOUBLE_QUOTED
        );

        $defaultsWithoutController = $symfonyRouteMetadata->getDefaultsWithoutController();
        if ($defaultsWithoutController !== []) {
            $arrayItemNodes[] = new ArrayItemNode($defaultsWithoutController, 'defaults');
        }

        if ($symfonyRouteMetadata->getHost() !== '') {
            $arrayItemNodes[] = new ArrayItemNode($symfonyRouteMetadata->getHost(), 'host');
        }

        if ($symfonyRouteMetadata->getSchemes() !== []) {
            $schemesArrayItemNodes = $this->arrayParser->createArrayFromValues($symfonyRouteMetadata->getSchemes());
            $arrayItemNodes[] = new ArrayItemNode($schemesArrayItemNodes, 'schemes');
        }

        if ($symfonyRouteMetadata->getMethods() !== []) {
            $arrayItemNodes[] = new ArrayItemNode($symfonyRouteMetadata->getMethods(), 'methods');
        }

        if ($symfonyRouteMetadata->getCondition() !== '') {
            $arrayItemNodes[] = new ArrayItemNode($symfonyRouteMetadata->getCondition(), 'condition');
        }

        if ($symfonyRouteMetadata->getRequirements() !== []) {
            $arrayItemNodes[] = new ArrayItemNode($symfonyRouteMetadata->getRequirements(), 'requirements');
        }

        $optionsWithoutDefaultCompilerClass = $symfonyRouteMetadata->getOptionsWithoutDefaultCompilerClass();
        if ($optionsWithoutDefaultCompilerClass !== []) {
            $arrayItemNodes[] = new ArrayItemNode($optionsWithoutDefaultCompilerClass, 'options');
        }

        return $arrayItemNodes;
    }

    private function matchSymfonyRouteMetadataByControllerReference(string $controllerReference): ?SymfonyRouteMetadata
    {
        foreach ($this->symfonyRoutesProvider->provide() as $symfonyRouteMetadata) {
            if ($symfonyRouteMetadata->getControllerReference() === $controllerReference) {
                return $symfonyRouteMetadata;
            }
        }

        return null;
    }
}
