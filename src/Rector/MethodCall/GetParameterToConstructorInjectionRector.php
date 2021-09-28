<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\StringType;
use PHPStan\Type\TypeWithClassName;
use Rector\Core\Rector\AbstractRector;
use Rector\Naming\Naming\PropertyNaming;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\PostRector\Collector\PropertyToAddCollector;
use Rector\PostRector\ValueObject\PropertyMetadata;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\MethodCall\GetParameterToConstructorInjectionRector\GetParameterToConstructorInjectionRectorTest
 */
final class GetParameterToConstructorInjectionRector extends AbstractRector
{
    public function __construct(
        private PropertyNaming $propertyNaming,
        private ReflectionProvider $reflectionProvider,
        private PropertyToAddCollector $propertyToAddCollector
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns fetching of parameters via `getParameter()` in ContainerAware to constructor injection in Command and Controller in Symfony',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
class MyCommand extends ContainerAwareCommand
{
    public function someMethod()
    {
        $this->getParameter('someParameter');
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class MyCommand extends Command
{
    private $someParameter;

    public function __construct($someParameter)
    {
        $this->someParameter = $someParameter;
    }

    public function someMethod()
    {
        $this->someParameter;
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
        $varType = $this->nodeTypeResolver->resolve($node->var);
        if (! $varType instanceof TypeWithClassName) {
            return null;
        }

        $classReflection = $this->reflectionProvider->getClass($varType->getClassName());
        if (! $classReflection->isSubclassOf('Symfony\Bundle\FrameworkBundle\Controller\Controller')) {
            return null;
        }

        if (! $this->isName($node->name, 'getParameter')) {
            return null;
        }

        $firstArg = $node->args[0];
        if (! $firstArg instanceof Arg) {
            return null;
        }

        $stringArgument = $firstArg->value;
        if (! $stringArgument instanceof String_) {
            return null;
        }

        $parameterName = $stringArgument->value;

        $parameterName = Strings::replace($parameterName, '#\.#', '_');

        $propertyName = $this->propertyNaming->underscoreToName($parameterName);

        $classLike = $node->getAttribute(AttributeKey::CLASS_NODE);
        if (! $classLike instanceof Class_) {
            return null;
        }

        $propertyMetadata = new PropertyMetadata($propertyName, new StringType(), Class_::MODIFIER_PRIVATE);
        $this->propertyToAddCollector->addPropertyToClass($classLike, $propertyMetadata);

        return $this->nodeFactory->createPropertyFetch('this', $propertyName);
    }
}
