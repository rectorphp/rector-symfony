<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTagRemover;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Rector\AbstractRector;
use Rector\Symfony\Enum\FosAnnotation;
use Rector\Symfony\Enum\SymfonyAnnotation;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\InlineClassRoutePrefixRectorTest
 */
final class InlineClassRoutePrefixRector extends AbstractRector
{
    /**
     * @var string[]
     */
    private const SKIPPED_ANNOTATIONS = [
        FosAnnotation::REST_POST,
        FosAnnotation::REST_GET,
        FosAnnotation::REST_ROUTE,
    ];

    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly PhpDocTagRemover $phpDocTagRemover,
        private readonly DocBlockUpdater $docBlockUpdater,
        private readonly ControllerAnalyzer $controllerAnalyzer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Inline class route prefix to all method routes, to make single explicit source for route paths',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class SomeController
{
    /**
     * @Route("/action")
     */
    public function action()
    {
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    /**
     * @Route("/api/action")
     */
    public function action()
    {
    }
}
CODE_SAMPLE
                ),

            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Class_
    {
        if ($this->shouldSkipClass($node)) {
            return null;
        }

        // 1. detect and remove class-level Route annotation
        $classPhpDocInfo = $this->phpDocInfoFactory->createFromNode($node);
        if (! $classPhpDocInfo instanceof PhpDocInfo) {
            return null;
        }

        $classRouteTagValueNode = $classPhpDocInfo->getByAnnotationClass(SymfonyAnnotation::ROUTE);
        if (! $classRouteTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }

        $classRoutePathNode = $classRouteTagValueNode->getSilentValue() ?: $classRouteTagValueNode->getValue('path');
        if (! $classRoutePathNode instanceof ArrayItemNode) {
            return null;
        }

        if (! $classRoutePathNode->value instanceof StringNode) {
            return null;
        }

        $classRoutePath = $classRoutePathNode->value->value;

        // 2. inline prefix to all method routes
        $hasChanged = false;

        foreach ($node->getMethods() as $classMethod) {
            if (! $classMethod->isPublic()) {
                continue;
            }

            if ($classMethod->isMagic()) {
                continue;
            }

            // can be route method
            $methodPhpDocInfo = $this->phpDocInfoFactory->createFromNode($classMethod);
            if (! $methodPhpDocInfo instanceof PhpDocInfo) {
                continue;
            }

            $methodRouteTagValueNodes = $methodPhpDocInfo->findByAnnotationClass(SymfonyAnnotation::ROUTE);
            foreach ($methodRouteTagValueNodes as $methodRouteTagValueNode) {
                $routePathArrayItemNode = $methodRouteTagValueNode->getSilentValue() ?? $methodRouteTagValueNode->getValue(
                    'path'
                );
                if (! $routePathArrayItemNode instanceof ArrayItemNode) {
                    continue;
                }

                if (! $routePathArrayItemNode->value instanceof StringNode) {
                    continue;
                }

                $methodPrefix = $routePathArrayItemNode->value;
                $newMethodPath = $classRoutePath . $methodPrefix->value;

                $routePathArrayItemNode->value = new StringNode($newMethodPath);
                $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($classMethod);

                $hasChanged = true;
            }
        }

        if (! $hasChanged) {
            return null;
        }

        $this->phpDocTagRemover->removeTagValueFromNode($classPhpDocInfo, $classRouteTagValueNode);
        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        return $node;
    }

    private function shouldSkipClass(Class_ $class): bool
    {
        if (! $class->extends instanceof Name) {
            return true;
        }

        if (! $this->controllerAnalyzer->isController($class)) {
            return true;
        }

        foreach ($class->getMethods() as $classMethod) {
            if (! $classMethod->isPublic()) {
                continue;
            }

            if ($classMethod->isMagic()) {
                continue;
            }

            $classMethodPhpDocInfo = $this->phpDocInfoFactory->createFromNode($classMethod);
            if (! $classMethodPhpDocInfo instanceof PhpDocInfo) {
                continue;
            }

            // special cases for FOS rest that should be skipped
            if ($classMethodPhpDocInfo->hasByAnnotationClasses(self::SKIPPED_ANNOTATIONS)) {
                return true;
            }
        }

        return false;
    }
}
