<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\Return_;
use Rector\NodeRemoval\NodeRemover;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class FluentNodeRemover
{
    public function __construct(
        private NodeRemover $nodeRemover
    ) {
    }

    public function removeCurrentNode(MethodCall|Return_ $node): void
    {
        $parent = $node->getAttribute(AttributeKey::PARENT_NODE);
        if ($parent instanceof Assign) {
            $this->nodeRemover->removeNode($parent);
            return;
        }

        // part of method call
        if ($parent instanceof Arg) {
            $parentParent = $parent->getAttribute(AttributeKey::PARENT_NODE);
            if ($parentParent instanceof MethodCall) {
                $this->nodeRemover->removeNode($parentParent);
            }

            return;
        }

        $this->nodeRemover->removeNode($node);
    }
}
