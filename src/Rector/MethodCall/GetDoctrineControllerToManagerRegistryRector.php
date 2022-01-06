<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\Naming\Naming\PropertyNaming;
use Rector\PostRector\Collector\PropertyToAddCollector;
use Rector\PostRector\ValueObject\PropertyMetadata;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://github.com/symfony/symfony/pull/42422
 * @changelog https://github.com/symfony/symfony/pull/1195
 *
 * @see \Rector\Symfony\Tests\Rector\MethodCall\GetDoctrineControllerToManagerRegistryRector\GetDoctrineControllerToManagerRegistryRectorTest
 */
final class GetDoctrineControllerToManagerRegistryRector extends AbstractRector
{
    /**
     * @var array<string, string>
     */
    private const METHOD_NAME_TO_PROPERTY_TYPE = [
        'getDoctrine' => 'Doctrine\Persistence\ManagerRegistry',
    ];

    public function __construct(
        private readonly ControllerAnalyzer $controllerAnalyzer,
<<<<<<< HEAD
        private readonly PropertyToAddCollector $propertyToAddCollector,
=======
        private PropertyToAddCollector $propertyToAddCollector,
        private PropertyNaming $propertyNaming,
>>>>>>> make GetDoctrineControllerToManagerRegistryRector generic
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace $this->getDoctrine() calls in AbstractController with direct Doctrine\Persistence\ManagerRegistry service',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeController extends AbstractController
{
    public function run()
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;

final class SomeController extends AbstractController
{
    public function __construct(
        private ManagerRegistry $managerRegistry
    ) {
    }

    public function run()
    {
        $productRepository = $this->managerRegistry->getRepository(Product::class);
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
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->controllerAnalyzer->isController($node->var)) {
            return null;
        }

        foreach (self::METHOD_NAME_TO_PROPERTY_TYPE as $methodName => $propertyType) {
            if (! $this->isName($node->name, $methodName)) {
                continue;
            }

            $propertyName = $this->propertyNaming->fqnToVariableName($propertyType);

            $class = $this->betterNodeFinder->findParentType($node, Class_::class);
            if (! $class instanceof Class_) {
                return null;
            }

            // add dependency
            $propertyObjectType = new ObjectType($propertyType);
            $propertyMetadata = new PropertyMetadata($propertyName, $propertyObjectType, Class_::MODIFIER_PRIVATE);
            $this->propertyToAddCollector->addPropertyToClass($class, $propertyMetadata);

            $thisVariable = new Variable('this');
            return new PropertyFetch($thisVariable, $propertyName);
        }

        return null;
    }
}
