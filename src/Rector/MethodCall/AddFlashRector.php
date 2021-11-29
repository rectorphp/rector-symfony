<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Rector\Defluent\NodeAnalyzer\FluentChainMethodCallNodeAnalyzer;
use Rector\Symfony\TypeAnalyzer\ControllerAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Symfony\Tests\Rector\MethodCall\AddFlashRector\AddFlashRectorTest
 */
final class AddFlashRector extends AbstractRector
{
    public function __construct(
        private FluentChainMethodCallNodeAnalyzer $fluentChainMethodCallNodeAnalyzer,
        private ControllerAnalyzer $controllerAnalyzer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns long flash adding to short helper method in Controller in Symfony',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
class SomeController extends Controller
{
    public function some(Request $request)
    {
        $request->getSession()->getFlashBag()->add("success", "something");
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class SomeController extends Controller
{
    public function some(Request $request)
    {
        $this->addFlash("success", "something");
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
        if (! $this->controllerAnalyzer->detect($node)) {
            return null;
        }

        if (! $this->fluentChainMethodCallNodeAnalyzer->isTypeAndChainCalls(
            $node,
            new ObjectType('Symfony\Component\HttpFoundation\Request'),
            ['getSession', 'getFlashBag', 'add']
        )
        ) {
            return null;
        }

        return $this->nodeFactory->createMethodCall('this', 'addFlash', $node->args);
    }
}
