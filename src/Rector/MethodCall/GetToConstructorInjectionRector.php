<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\NodeAnalyzer\DependencyInjectionMethodCallAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\GetToConstructorInjectionRectorTest
 */
final class GetToConstructorInjectionRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var string
     */
    public const GET_METHOD_AWARE_TYPES = 'get_method_aware_types';

    /**
     * @var ObjectType[]
     */
    private array $getMethodAwareObjectTypes = [];

    public function __construct(
        private DependencyInjectionMethodCallAnalyzer $dependencyInjectionMethodCallAnalyzer
    ) {
        $this->getMethodAwareObjectTypes = [
            new ObjectType('Symfony\Bundle\FrameworkBundle\Controller\Controller'),
            new ObjectType('Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait'),
        ];
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns fetching of dependencies via `$this->get()` to constructor injection in Command and Controller in Symfony',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
class MyCommand extends ContainerAwareCommand
{
    public function someMethod()
    {
        // ...
        $this->get('some_service');
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class MyCommand extends Command
{
    public function __construct(SomeService $someService)
    {
        $this->someService = $someService;
    }

    public function someMethod()
    {
        $this->someService;
    }
}
CODE_SAMPLE
                    ,
                    [
                        self::GET_METHOD_AWARE_TYPES => ['SymfonyControllerClassName', 'GetTraitClassName'],
                    ]
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
        if (! $this->nodeTypeResolver->isObjectTypes($node->var, $this->getMethodAwareObjectTypes)) {
            return null;
        }

        if (! $this->isName($node->name, 'get')) {
            return null;
        }

        return $this->dependencyInjectionMethodCallAnalyzer->replaceMethodCallWithPropertyFetchAndDependency($node);
    }

    /**
     * @param array<string, mixed> $configuration
     */
    public function configure(array $configuration): void
    {
        $getMethodAwareTypes = $configuration[self::GET_METHOD_AWARE_TYPES] ?? [];

        foreach ($getMethodAwareTypes as $getMethodAwareType) {
            $this->getMethodAwareObjectTypes[] = new ObjectType($getMethodAwareType);
        }
    }
}
