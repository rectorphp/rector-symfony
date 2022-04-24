<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Expression;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\Symfony\NodeAnalyzer\SymfonyTestCaseAnalyzer;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://symfony.com/blog/new-in-symfony-4-3-better-test-assertions
 * @changelog https://github.com/symfony/symfony/pull/30813
 *
 * @see \Rector\Symfony\Tests\Rector\MethodCall\SimplifyWebTestCaseAssertionsRector\SimplifyWebTestCaseAssertionsRectorTest
 */
final class SimplifyWebTestCaseAssertionsRector extends AbstractRector
{
    public function __construct(
        private readonly SymfonyTestCaseAnalyzer $symfonyTestCaseAnalyzer
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Simplify use of assertions in WebTestCase', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

final class SomeClass extends TestCase
{
    public function test()
    {
        $this->assertSame(301, $client->getResponse()->getStatusCode());
        $this->assertSame('https://example.com', $client->getResponse()->headers->get('Location'));
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

final class SomeClass extends TestCase
{
    public function test()
    {
        $this->assertResponseRedirects('https://example.com', 301);
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
        return [FunctionLike::class];
    }

    /**
     * @param FunctionLike $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->symfonyTestCaseAnalyzer->isInWebTestCase($node)) {
            return null;
        }

        $stmts = $node->getStmts();
        if ($stmts === null) {
            return null;
        }

        $getStatusCodeMethodCall = $this->createGetStatusMethodCall();

        foreach ($stmts as $stmt) {
            if (! $stmt instanceof Expression) {
                continue;
            }

            $expr = $stmt->expr;
            if (! $expr instanceof MethodCall) {
                continue;
            }

            // assertResponseStatusCodeSame
            $newMethodCall = $this->processAssertResponseStatusCodeSame($expr, $getStatusCodeMethodCall);
            if ($newMethodCall !== null) {
                $stmt->expr = $newMethodCall;
                continue;
            }

            return $this->processAssertResponseRedirects($expr, $getStatusCodeMethodCall);
        }

        return $node;
    }

    private function processAssertResponseStatusCodeSame(
        MethodCall $methodCall,
        MethodCall $getStatusCodeMethodCall
    ): ?MethodCall {
        if (! $this->isName($methodCall->name, 'assertSame')) {
            return null;
        }

        $secondArg = $methodCall->args[1];
        if (! $secondArg instanceof Arg) {
            return null;
        }

        if (! $this->nodeComparator->areNodesEqual($secondArg->value, $getStatusCodeMethodCall)) {
            return null;
        }

        $firstArg = $methodCall->args[0];
        if (! $firstArg instanceof Arg) {
            return null;
        }

        $statusCode = $this->valueResolver->getValue($firstArg->value);

        // handled by another methods
        if (in_array($statusCode, [200, 301], true)) {
            return null;
        }

        return $this->nodeFactory->createLocalMethodCall('assertResponseStatusCodeSame', [$methodCall->args[0]]);
    }

    private function processAssertResponseRedirects(
        MethodCall $methodCall,
        MethodCall $getStatusCodeMethodCall
    ): ?MethodCall {
        /** @var Expression|null $previousStatement */
        $previousStatement = $methodCall->getAttribute(AttributeKey::PREVIOUS_STATEMENT);
        if (! $previousStatement instanceof Expression) {
            return null;
        }

        $previousNode = $previousStatement->expr;
        if (! $previousNode instanceof MethodCall) {
            return null;
        }

        $args = [];
        $args[] = new Arg(new LNumber(301));
        $args[] = new Arg($getStatusCodeMethodCall);

        $match = $this->nodeFactory->createLocalMethodCall('assertSame', $args);

        if ($this->nodeComparator->areNodesEqual($previousNode, $match)) {
            $getResponseMethodCall = $this->nodeFactory->createMethodCall('client', 'getResponse');
            $propertyFetch = new PropertyFetch($getResponseMethodCall, 'headers');
            $clientGetLocation = $this->nodeFactory->createMethodCall(
                $propertyFetch,
                'get',
                [new Arg(new String_('Location'))]
            );

            if (! isset($methodCall->args[1])) {
                return null;
            }

            $firstArg = $methodCall->args[1];
            if (! $firstArg instanceof Arg) {
                return null;
            }

            if ($this->nodeComparator->areNodesEqual($firstArg->value, $clientGetLocation)) {
                $args = [];
                $args[] = $methodCall->args[0];
                $args[] = $previousNode->args[0];

                return $this->nodeFactory->createLocalMethodCall('assertResponseRedirects', $args);
            }
        }

        return null;
    }

    private function createGetStatusMethodCall(): MethodCall
    {
        $clientGetResponseMethodCall = $this->nodeFactory->createMethodCall('client', 'getResponse');
        return $this->nodeFactory->createMethodCall($clientGetResponseMethodCall, 'getStatusCode');
    }
}
