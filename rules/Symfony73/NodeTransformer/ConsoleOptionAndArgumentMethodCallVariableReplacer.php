<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeTransformer;

use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Exception\ShouldNotHappenException;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\PhpDocParser\NodeTraverser\SimpleCallableNodeTraverser;
use Rector\PhpParser\Node\Value\ValueResolver;

final readonly class ConsoleOptionAndArgumentMethodCallVariableReplacer
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private SimpleCallableNodeTraverser $simpleCallableNodeTraverser,
        private ValueResolver $valueResolver,
    ) {
    }

    public function replace(ClassMethod $executeClassMethod): void
    {
        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($executeClassMethod->stmts, function (
            Node $node
        ): ?Variable {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $this->nodeNameResolver->isName($node->var, 'input')) {
                return null;
            }

            if (! $this->nodeNameResolver->isNames($node->name, ['getOption', 'getArgument'])) {
                return null;
            }

            $firstArgValue = $node->getArgs()[0]
                ->value;

            if ($firstArgValue instanceof ClassConstFetch || $firstArgValue instanceof ConstFetch) {
                $variableName = $this->valueResolver->getValue($firstArgValue);
                return new Variable(str_replace('-', '_', $variableName));
            }

            if (! $firstArgValue instanceof String_) {
                // unable to resolve argument/option name
                throw new ShouldNotHappenException();
            }

            $variableName = $firstArgValue->value;
            return new Variable(str_replace('-', '_', $variableName));
        });
    }
}
