<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Expression;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://symfony.com/blog/new-in-symfony-4-3-better-test-assertions
 * @changelog https://github.com/symfony/symfony/pull/30813
 *
 * @see \Rector\Symfony\Tests\Rector\MethodCall\SimplifyWebTestCaseAssertionsRector\SimplifyWebTestCaseAssertionsRectorTest
 *
 * @todo possibly split into 2/3 rules?
 */
final class SimplifyWebTestCaseAssertionsRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Simplify use of assertions in WebTestCase', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

class SomeClass extends TestCase
{
    public function testUrl()
    {
        $this->assertSame(301, $client->getResponse()->getStatusCode());
        $this->assertSame('https://example.com', $client->getResponse()->headers->get('Location'));
    }

    public function testContains()
    {
        $this->assertContains('Hello World', $crawler->filter('h1')->text());
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

class SomeClass extends TestCase
{
    public function testUrl()
    {
        $this->assertResponseRedirects('https://example.com', 301);
    }

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
        return [FunctionLike::class];
    }

    /**
     * @param FunctionLike $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isInWebTestCase($node)) {
            return null;
        }

        $getStatusCodeMethodCall = $this->createGetStatusMethodCall();

        foreach ($node->getStmts() as $key => $stmt) {
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

            // assertSelectorTextContains
            $args = $this->matchAssertContainsCrawlerArg($expr);
            if ($args !== null) {
                $stmt->expr = $this->nodeFactory->createLocalMethodCall('assertSelectorTextContains', $args);
                continue;
            }

            return $this->processAssertResponseRedirects($expr, $getStatusCodeMethodCall);
        }

        return $node;
    }

    private function isInWebTestCase(FunctionLike $functionLike): bool
    {
        $scope = $functionLike->getAttribute(AttributeKey::SCOPE);
        if (! $scope instanceof Scope) {
            return false;
        }

        $classReflection = $scope->getClassReflection();
        if (! $classReflection instanceof ClassReflection) {
            return false;
        }

        return $classReflection->isSubclassOf('Symfony\Bundle\FrameworkBundle\Test\WebTestCase');
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

    /**
     * @return Arg[]|null
     */
    private function matchAssertContainsCrawlerArg(MethodCall $methodCall): ?array
    {
        if (! $this->isName($methodCall->name, 'assertContains')) {
            return null;
        }

        $secondArg = $methodCall->args[1];
        if (! $secondArg instanceof Arg) {
            return null;
        }

        $comparedNode = $secondArg->value;
        if (! $comparedNode instanceof MethodCall) {
            return null;
        }

        if (! $comparedNode->var instanceof MethodCall) {
            return null;
        }

        $comparedMethodCaller = $comparedNode->var;
        if (! $comparedMethodCaller->var instanceof Variable) {
            return null;
        }

        if (! $this->isName($comparedMethodCaller->var, 'crawler')) {
            return null;
        }

        if (! $this->isName($comparedNode->name, 'text')) {
            return null;
        }

        $args = [];
        $args[] = $comparedNode->var->args[0];
        $args[] = $methodCall->args[0];

        /** @var Arg[] $args */
        return $args;
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
