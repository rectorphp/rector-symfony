<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Return_;
use PhpParser\NodeVisitor;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\PhpDocParser\NodeTraverser\SimpleCallableNodeTraverser;
use Rector\PhpParser\Node\NodeFactory;

final readonly class OnSuccessLogoutClassMethodFactory
{
    /**
     * @var string
     */
    private const LOGOUT_EVENT = 'logoutEvent';

    public function __construct(
        private NodeFactory $nodeFactory,
        private NodeNameResolver $nodeNameResolver,
        private SimpleCallableNodeTraverser $simpleCallableNodeTraverser,
        private BareLogoutClassMethodFactory $bareLogoutClassMethodFactory
    ) {
    }

    public function createFromOnLogoutSuccessClassMethod(ClassMethod $onLogoutSuccessClassMethod): ClassMethod
    {
        $classMethod = $this->bareLogoutClassMethodFactory->create();

        $getResponseMethodCall = new MethodCall(new Variable(self::LOGOUT_EVENT), 'getResponse');
        $notIdentical = new NotIdentical($getResponseMethodCall, $this->nodeFactory->createNull());

        $if = new If_($notIdentical);
        $if->stmts[] = new Return_();

        // replace `return $response;` with `$logoutEvent->setResponse($response)`
        $this->replaceReturnResponseWithSetResponse($onLogoutSuccessClassMethod);
        $this->replaceRequestWithGetRequest($onLogoutSuccessClassMethod);

        $oldClassStmts = (array) $onLogoutSuccessClassMethod->stmts;
        $classMethod->stmts = [$if, ...$oldClassStmts];

        return $classMethod;
    }

    private function replaceReturnResponseWithSetResponse(ClassMethod $classMethod): void
    {
        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($classMethod, function (Node $node): ?Expression {
            if (! $node instanceof Return_) {
                return null;
            }

            if (! $node->expr instanceof Expr) {
                return null;
            }

            $args = $this->nodeFactory->createArgs([$node->expr]);
            $methodCall = new MethodCall(new Variable(self::LOGOUT_EVENT), 'setResponse', $args);

            return new Expression($methodCall);
        });
    }

    private function replaceRequestWithGetRequest(ClassMethod $classMethod): void
    {
        $this->simpleCallableNodeTraverser->traverseNodesWithCallable(
            $classMethod,
            function (Node $node): int|null|MethodCall {
                if ($node instanceof Param) {
                    return NodeVisitor::DONT_TRAVERSE_CURRENT_AND_CHILDREN;
                }

                if (! $node instanceof Variable) {
                    return null;
                }

                if (! $this->nodeNameResolver->isName($node, 'request')) {
                    return null;
                }

                return new MethodCall(new Variable(self::LOGOUT_EVENT), 'getRequest');
            }
        );
    }
}
