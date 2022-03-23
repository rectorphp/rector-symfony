<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Namespace_;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\PhpParser\Node\CustomNode\FileWithoutNamespace;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\MethodName;
use Rector\Symfony\NodeAnalyzer\SymfonyControllerFilter;
use Rector\Symfony\NodeFactory\InvokableControllerClassFactory;
use Rector\Symfony\NodeFactory\InvokableControllerNameFactory;
use Rector\Symfony\Printer\NeighbourClassLikePrinter;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://symfony.com/doc/2.8/controller/service.html#referring-to-the-service
 *
 * @see \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\InvokableControllerRectorTest
 *
 * Inspiration @see https://github.com/rectorphp/rector-src/blob/main/rules/PSR4/Rector/Namespace_/MultipleClassFileToPsr4ClassesRector.php
 */
final class InvokableControllerRector extends AbstractRector
{
    public function __construct(
        private readonly ControllerAnalyzer $controllerAnalyzer,
        private readonly SymfonyControllerFilter $symfonyControllerFilter,
        private readonly InvokableControllerNameFactory $invokableControllerNameFactory,
        private readonly NeighbourClassLikePrinter $neighbourClassLikePrinter,
        private readonly InvokableControllerClassFactory $invokableControllerClassFactory
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Change god controller to single-action invokable controllers', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function detailAction()
    {
    }

    public function listAction()
    {
    }
}
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeDetailController extends Controller
{
    public function __invoke()
    {
    }
}

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeListController extends Controller
{
    public function __invoke()
    {
    }
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
        // skip anonymous controllers
        if (! $node->name instanceof Identifier) {
            return null;
        }

        if (! $this->controllerAnalyzer->isInsideController($node)) {
            return null;
        }

        $actionClassMethods = $this->symfonyControllerFilter->filterActionMethods($node);
        if ($actionClassMethods === []) {
            return null;
        }

        // 1. single action method → only rename
        if (count($actionClassMethods) === 1) {
            return $this->refactorSingleAction($actionClassMethods[0], $node);
        }

        // 2. multiple action methods → split + rename current based on action name
        foreach ($actionClassMethods as $actionClassMethod) {
            $actionMethodName = $actionClassMethod->name->toString();

            $newControllerName = $this->invokableControllerNameFactory->createControllerName(
                $node->name,
                $actionMethodName
            );

            $newClassLike = $this->invokableControllerClassFactory->createWithActionClassMethod(
                $node,
                $actionClassMethod,
                $newControllerName
            );

            /** @var Namespace_|FileWithoutNamespace|null $parentNamespace */
            $parentNamespace = $this->betterNodeFinder->findParentByTypes(
                $node,
                [Namespace_::class, FileWithoutNamespace::class]
            );
            if (! $parentNamespace instanceof \PhpParser\Node) {
                throw new ShouldNotHappenException('Missing parent namespace or without namespace node');
            }

            $this->neighbourClassLikePrinter->printClassLike(
                $newClassLike,
                $parentNamespace,
                $this->file->getSmartFileInfo()
            );
        }

        // remove original file
        $smartFileInfo = $this->file->getSmartFileInfo();
        $this->removedAndAddedFilesCollector->removeFile($smartFileInfo);

        return null;
    }

    private function refactorSingleAction(ClassMethod $actionClassMethod, Class_ $class): Class_
    {
        $actionClassMethod->name = new Identifier(MethodName::INVOKE);
        return $class;
    }
}