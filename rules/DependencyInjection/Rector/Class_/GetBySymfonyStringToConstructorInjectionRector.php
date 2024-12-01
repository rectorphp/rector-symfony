<?php

declare(strict_types=1);

namespace Rector\Symfony\DependencyInjection\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Reflection\ClassReflection;
use Rector\Naming\Naming\PropertyNaming;
use Rector\NodeManipulator\ClassDependencyManipulator;
use Rector\PHPStan\ScopeFetcher;
use Rector\PostRector\ValueObject\PropertyMetadata;
use Rector\Rector\AbstractRector;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Rector\Symfony\DependencyInjection\ThisGetTypeMatcher;
use Rector\Symfony\Enum\SymfonyClass;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\GetBySymfonyStringToConstructorInjectionRectorTest
 */
final class GetBySymfonyStringToConstructorInjectionRector extends AbstractRector
{
    /**
     * @var array<string, string>
     */
    private const SYMFONY_NAME_TO_TYPE_MAP = [
        'validator' => SymfonyClass::VALIDATOR_INTERFACE,
        'event_dispatcher' => SymfonyClass::EVENT_DISPATCHER_INTERFACE,
        'logger' => SymfonyClass::LOGGER_INTERFACE,
        'jms_serializer' => SymfonyClass::SERIALIZER_INTERFACE,
    ];

    public function __construct(
        private readonly ClassDependencyManipulator $classDependencyManipulator,
        private readonly ThisGetTypeMatcher $thisGetTypeMatcher,
        private readonly PropertyNaming $propertyNaming,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Converts typical Symfony services like $this->get("validator") in commands/controllers to constructor injection (step 3/x)',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SomeController extends Controller
{
    public function someMethod()
    {
        $someType = $this->get('validator');
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SomeController extends Controller
{
    public function __construct(private ValidatorInterface $validator)

    public function someMethod()
    {
        $someType = $this->validator;
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
        if ($this->shouldSkipClass($node)) {
            return null;
        }

        $propertyMetadatas = [];

        $this->traverseNodesWithCallable($node, function (Node $node) use (&$propertyMetadatas): ?Node {
            if (! $node instanceof MethodCall) {
                return null;
            }

            $serviceName = $this->thisGetTypeMatcher->matchString($node);
            if (! is_string($serviceName)) {
                return null;
            }

            $serviceType = self::SYMFONY_NAME_TO_TYPE_MAP[$serviceName] ?? null;
            if ($serviceType === null) {
                return null;
            }

            $propertyName = $this->propertyNaming->fqnToVariableName($serviceType);
            $propertyMetadata = new PropertyMetadata($propertyName, new FullyQualifiedObjectType($serviceType));

            $propertyMetadatas[] = $propertyMetadata;
            return $this->nodeFactory->createPropertyFetch('this', $propertyMetadata->getName());
        });

        if ($propertyMetadatas === []) {
            return null;
        }

        foreach ($propertyMetadatas as $propertyMetadata) {
            $this->classDependencyManipulator->addConstructorDependency($node, $propertyMetadata);
        }

        return $node;
    }

    private function shouldSkipClass(Class_ $class): bool
    {
        $scope = ScopeFetcher::fetch($class);

        $classReflection = $scope->getClassReflection();
        if (! $classReflection instanceof ClassReflection) {
            return true;
        }

        if ($classReflection->isSubclassOf(SymfonyClass::CONTAINER_AWARE_COMMAND)) {
            return false;
        }

        return ! $classReflection->isSubclassOf(SymfonyClass::CONTROLLER);
    }
}
