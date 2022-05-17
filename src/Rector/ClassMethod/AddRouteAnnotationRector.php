<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\BetterPhpDocParser\ValueObject\PhpDoc\DoctrineAnnotation\CurlyListNode;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\DataProvider\RouteMapProvider;
use Rector\Symfony\PhpDocNode\SymfonyRouteTagValueNodeFactory;
use Rector\Symfony\ValueObject\SymfonyRouteMetadata;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\AddRouteAnnotationRectorTest
 */
class AddRouteAnnotationRector extends AbstractRector
{
    public function __construct(
        private readonly RouteMapProvider $routeMapProvider,
        private readonly SymfonyRouteTagValueNodeFactory $symfonyRouteTagValueNodeFactory
    ) {
    }

    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    public function refactor(Node $node): ?Node
    {
        if (! $node instanceof ClassMethod) {
            return null;
        }

        $routeMap = $this->routeMapProvider->provide();
        if (! $routeMap->hasRoutes()) {
            return null;
        }

        $class = $this->betterNodeFinder->findParentType($node, Class_::class);

        if (! $class instanceof Class_) {
            return null;
        }

        $className = $this->nodeNameResolver->getName($class);
        $methodName = $this->nodeNameResolver->getName($node);

        $fqcnAndMethodName = sprintf('%s::%s', $className, $methodName);
        $symfonyRouteMetadata = $routeMap->getRouteByMethod($fqcnAndMethodName);

        if (! $symfonyRouteMetadata instanceof SymfonyRouteMetadata) {
            return null;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);
        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClass(
            'Symfony\\Component\\Routing\\Annotation\\Route'
        );

        if ($doctrineAnnotationTagValueNode !== null) {
            return null;
        }

        $items = [
            'path' => sprintf('"%s"', $symfonyRouteMetadata->getPath()),
            'name' => sprintf('"%s"', $symfonyRouteMetadata->getName()),
        ];

        $defaults = $symfonyRouteMetadata->getDefaults();
        unset($defaults['_controller']);
        if ($defaults !== []) {
            $items['defaults'] = new CurlyListNode(
                array_map(static fn (mixed $default): mixed => match (true) {
                    is_string($default) => sprintf('"%s"', $default),
                    default => $default,
                }, $defaults)
            );
        }

        if ($symfonyRouteMetadata->getHost() !== '') {
            $items['host'] = sprintf('"%s"', $symfonyRouteMetadata->getHost());
        }

        if ($symfonyRouteMetadata->getSchemes() !== []) {
            $items['schemes'] = new CurlyListNode(
                array_map(
                    static fn (string $scheme): string => sprintf('"%s"', $scheme),
                    $symfonyRouteMetadata->getSchemes()
                )
            );
        }

        if ($symfonyRouteMetadata->getMethods() !== []) {
            $items['methods'] = new CurlyListNode(
                array_map(
                    static fn (string $scheme): string => sprintf('"%s"', $scheme),
                    $symfonyRouteMetadata->getMethods()
                )
            );
        }

        if ($symfonyRouteMetadata->getCondition() !== '') {
            $items['condition'] = sprintf('"%s"', $symfonyRouteMetadata->getCondition());
        }

        $phpDocInfo->addTagValueNode($this->symfonyRouteTagValueNodeFactory->createFromItems($items));

        return $node;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Add route annotation to controller action', []);
    }
}
