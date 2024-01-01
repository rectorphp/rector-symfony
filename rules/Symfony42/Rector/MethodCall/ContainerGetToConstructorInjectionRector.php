<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony42\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use PHPStan\Type\ObjectType;
use Rector\NodeManipulator\ClassDependencyManipulator;
use Rector\Rector\AbstractRector;
use Rector\ValueObject\MethodName;
use Rector\PHPUnit\NodeAnalyzer\TestsNodeAnalyzer;
use Rector\PostRector\ValueObject\PropertyMetadata;
use Rector\Symfony\NodeAnalyzer\DependencyInjectionMethodCallAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Ref: https://github.com/symfony/symfony/blob/master/UPGRADE-4.0.md#console
 *
 * @see \Rector\Symfony\Tests\Symfony42\Rector\MethodCall\ContainerGetToConstructorInjectionRector\ContainerGetToConstructorInjectionRectorTest
 */
final class ContainerGetToConstructorInjectionRector extends AbstractRector
{
    public function __construct(
        private readonly DependencyInjectionMethodCallAnalyzer $dependencyInjectionMethodCallAnalyzer,
        private readonly TestsNodeAnalyzer $testsNodeAnalyzer,
        private readonly ClassDependencyManipulator $classDependencyManipulator,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns fetching of dependencies via `$container->get()` in ContainerAware to constructor injection in Command and Controller in Symfony',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
final class SomeCommand extends ContainerAwareCommand
{
    public function someMethod()
    {
        // ...
        $this->getContainer()->get('some_service');
        $this->container->get('some_service');
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
final class SomeCommand extends ContainerAwareCommand
{
    public function __construct(SomeService $someService)
    {
        $this->someService = $someService;
    }

    public function someMethod()
    {
        // ...
        $this->someService;
        $this->someService;
    }
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
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($this->testsNodeAnalyzer->isInTestClass($node)) {
            return null;
        }

        $class = $node;
        $propertyMetadatas = [];

        $this->traverseNodesWithCallable($class, function (Node $node) use ($class, &$propertyMetadatas): ?Node {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $this->isName($node->name, 'get')) {
                return null;
            }

            if (! $this->isObjectType(
                $node->var,
                new ObjectType('Symfony\Component\DependencyInjection\ContainerInterface')
            )) {
                return null;
            }

            $propertyMetadata = $this->dependencyInjectionMethodCallAnalyzer->replaceMethodCallWithPropertyFetchAndDependency(
                $class,
                $node
            );

            if (! $propertyMetadata instanceof PropertyMetadata) {
                return null;
            }

            $propertyMetadatas[] = $propertyMetadata;
            return $this->nodeFactory->createPropertyFetch('this', $propertyMetadata->getName());
        });

        if ($propertyMetadatas === []) {
            return null;
        }

        foreach ($propertyMetadatas as $propertyMetadata) {
            $this->classDependencyManipulator->addConstructorDependency($class, $propertyMetadata);
        }

        $this->decorateCommandConstructor($class);

        return $node;
    }

    private function decorateCommandConstructor(Class_ $class): void
    {
        // special case for command to keep parent constructor call
        if (! $this->isObjectType($class, new ObjectType('Symfony\Component\Console\Command\Command'))) {
            return;
        }

        $constuctClassMethod = $class->getMethod(MethodName::CONSTRUCT);
        if (! $constuctClassMethod instanceof ClassMethod) {
            return;
        }

        // empty stmts? add parent::__construct() to setup command
        if ((array) $constuctClassMethod->stmts === []) {
            $parentConstructStaticCall = new StaticCall(new Name('parent'), '__construct');
            $constuctClassMethod->stmts[] = new Expression($parentConstructStaticCall);
        }
    }
}
