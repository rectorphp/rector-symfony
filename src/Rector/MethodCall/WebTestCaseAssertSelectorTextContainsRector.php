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
 * @see \Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertSelectorTextContainsRector\WebTestCaseAssertSelectorTextContainsRectorTest
 */
final class WebTestCaseAssertSelectorTextContainsRector extends AbstractRector
{
    public function __construct(
        private SymfonyTestCaseAnalyzer $symfonyTestCaseAnalyzer,
        private TestsNodeAnalyzer $testsNodeAnalyzer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Simplify use of assertions in WebTestCase to assertSelectorTextContains()', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SomeTest extends WebTestCase
{
    public function testContains()
    {
        $this->assertContains('Hello World', $this->crawler->filter('h1')->text());
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SomeTest extends WebTestCase
{
    public function testContains()
    {
        $this->assertSelectorTextContains('h1', 'Hello World');
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
