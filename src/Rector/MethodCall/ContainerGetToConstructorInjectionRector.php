<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\Symfony\NodeAnalyzer\DependencyInjectionMethodCallAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Ref: https://github.com/symfony/symfony/blob/master/UPGRADE-4.0.md#console
 *
 * @see \Rector\Symfony\Tests\Rector\MethodCall\ContainerGetToConstructorInjectionRector\ContainerGetToConstructorInjectionRectorTest
 */
final class ContainerGetToConstructorInjectionRector extends AbstractRector
{
    /**
     * @var class-string[]
     */
    private const CONTAINER_AWARE_TYPES = [
        'Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand',
        'Symfony\Bundle\FrameworkBundle\Controller\Controller',
        'Symfony\Bundle\FrameworkBundle\Controller\AbstractController',
    ];

    public function __construct(
        private DependencyInjectionMethodCallAnalyzer $dependencyInjectionMethodCallAnalyzer,
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
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isObjectType(
            $node->var,
            new ObjectType('Symfony\Component\DependencyInjection\ContainerInterface')
        )) {
            return null;
        }

        if (! $this->isName($node->name, 'get')) {
            return null;
        }

        if (! $this->isContainerAwareSubclass($node)) {
            return null;
        }

        return $this->dependencyInjectionMethodCallAnalyzer->replaceMethodCallWithPropertyFetchAndDependency($node);
    }

    private function isContainerAwareSubclass(MethodCall $methodCall): bool
    {
        $scope = $methodCall->getAttribute(AttributeKey::SCOPE);
        if (! $scope instanceof Scope) {
            return false;
        }

        $classReflection = $scope->getClassReflection();
        if (! $classReflection instanceof ClassReflection) {
            return false;
        }

        foreach (self::CONTAINER_AWARE_TYPES as $containerAwareType) {
            if ($classReflection->isSubclassOf($containerAwareType)) {
                return true;
            }
        }

        return false;
    }
}
