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
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\MethodName;
use Rector\FileSystemRector\ValueObject\AddedFileWithNodes;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\Symfony\NodeAnalyzer\SymfonyControllerFilter;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://symfony.com/doc/2.8/controller/service.html#referring-to-the-service
 *
 * @see \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\InvokableControllerRectorTest
 */
final class InvokableControllerRector extends AbstractRector
{
    public function __construct(
        private ControllerAnalyzer $controllerAnalyzer,
        private SymfonyControllerFilter $symfonyControllerFilter,
        private \Rector\Symfony\NodeFactory\InvokableControllerNameFactory $invokableControllerNameFactory
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

            $newNamespace = $this->buildNewClassWithActionMethod($node, $actionClassMethod, $newControllerName);

            // print to different location
            $filePath = $this->file->getRelativeFilePath();
            $newFilePath = dirname($filePath) . '/' . $newControllerName . '.php';

            // @todo here should be namespace too
            $addedFile = new AddedFileWithNodes($newFilePath, [$newNamespace]);
            $this->removedAndAddedFilesCollector->addAddedFile($addedFile);
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

    private function buildNewClassWithActionMethod(
        Class_ $class,
        ClassMethod $actionClassMethod,
        string $controllerName
    ): Namespace_
    {
        $actionClassMethod->name = new Identifier(MethodName::INVOKE);

        $classParent = $class->getAttribute(AttributeKey::PARENT_NODE);

        if (! $classParent instanceof Namespace_) {
            // we're unable to resolve namespace-less controllers
            throw new ShouldNotHappenException();
        }

        $newClass = clone $class;

        foreach ($newClass->stmts as $key => $classStmt) {
            if (! $classStmt instanceof ClassMethod) {
                continue;
            }

            if (! $classStmt->isPublic()) {
                continue;
            }

            unset($newClass->stmts[$key]);
        }

        $newClass->stmts[] = $actionClassMethod;

        $newClass->name = new Identifier($controllerName);
        $classParent->stmts = [$newClass];

        return $classParent;
    }
}
