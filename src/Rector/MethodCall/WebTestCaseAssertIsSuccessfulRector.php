<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use Rector\Core\Rector\AbstractRector;
use Rector\PHPUnit\NodeAnalyzer\TestsNodeAnalyzer;
use Rector\Symfony\NodeAnalyzer\SymfonyTestCaseAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://symfony.com/blog/new-in-symfony-4-3-better-test-assertions
 * @changelog https://github.com/symfony/symfony/pull/30813
 *
 * @see \Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\WebTestCaseAssertIsSuccessfulRectorTest
 */
final class WebTestCaseAssertIsSuccessfulRector extends AbstractRector
{
    public function __construct(
        private readonly SymfonyTestCaseAnalyzer $symfonyTestCaseAnalyzer,
        private readonly TestsNodeAnalyzer $testsNodeAnalyzer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Simplify use of assertions in WebTestCase', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

class SomeClass extends TestCase
{
    public function test()
    {
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

class SomeClass extends TestCase
{
    public function test()
    {
         $this->assertResponseIsSuccessful();
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
        return [MethodCall::class, StaticCall::class];
    }

    /**
     * @param MethodCall|StaticCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->symfonyTestCaseAnalyzer->isInWebTestCase($node)) {
            return null;
        }

        if (! $this->testsNodeAnalyzer->isAssertMethodCallName($node, 'assertSame')) {
            return null;
        }

        $args = $node->getArgs();
        if (! $this->valueResolver->isValue($args[0]->value, 200)) {
            return null;
        }

        $secondArg = $args[1]->value;
        if (! $secondArg instanceof MethodCall) {
            return null;
        }

        if (! $this->isName($secondArg->name, 'getStatusCode')) {
            return null;
        }

        $node->name = new Identifier('assertResponseIsSuccessful');
        $node->args = [];

        return $node;
    }
}
