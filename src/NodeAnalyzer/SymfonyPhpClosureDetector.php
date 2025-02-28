<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\NodeVisitor;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\PhpDocParser\NodeTraverser\SimpleCallableNodeTraverser;
use Rector\PhpParser\Node\BetterNodeFinder;

final readonly class SymfonyPhpClosureDetector
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private BetterNodeFinder $betterNodeFinder,
        private SimpleCallableNodeTraverser $simpleCallableNodeTraverser,
    ) {
    }

    public function detect(Closure $closure): bool
    {
        if (count($closure->params) !== 1) {
            return false;
        }

        $firstParam = $closure->params[0];
        if (! $firstParam->type instanceof FullyQualified) {
            return false;
        }

        return $this->nodeNameResolver->isName(
            $firstParam->type,
            'Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator'
        );
    }

    public function hasDefaultsAutoconfigure(Closure $closure): bool
    {
        $hasDefaultsAutoconfigure = false;

        // has defaults autoconfigure?
        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($closure, function (Node $node) use (
            &$hasDefaultsAutoconfigure
        ): ?int {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $this->nodeNameResolver->isName($node->name, 'autoconfigure')) {
                return null;
            }

            /** @var MethodCall[] $methodCalls */
            $methodCalls = $this->betterNodeFinder->findInstanceOf($node, MethodCall::class);

            foreach ($methodCalls as $methodCall) {
                if (! $this->nodeNameResolver->isName($methodCall->name, 'defaults')) {
                    continue;
                }

                $hasDefaultsAutoconfigure = true;

                return NodeVisitor::DONT_TRAVERSE_CURRENT_AND_CHILDREN;
            }

            return null;
        });

        return $hasDefaultsAutoconfigure;
    }
}
