<?php

declare(strict_types=1);

namespace Rector\Symfony\Helper;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeTraverser;
use PHPStan\Type\ObjectType;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeRemoval\NodeRemover;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer;
use Rector\PhpDocParser\NodeTraverser\SimpleCallableNodeTraverser;
use Rector\Symfony\Enum\SymfonyAnnotation;
use Rector\Symfony\NodeAnalyzer\Command\AttributeValueResolver;

/**
 * @see \Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\CommandPropertyToAttributeRectorTest
 */
final class CommandHelper
{
    public function __construct(
        private readonly PhpAttributeAnalyzer $phpAttributeAnalyzer,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly NodeTypeResolver $nodeTypeResolver,
        private readonly SimpleCallableNodeTraverser $simpleCallableNodeTraverser,
        private readonly NodeRemover $nodeRemover,
        private readonly AttributeValueResolver $attributeValueResolver,
    ) {
    }

    public function getCommandHiddenValueFromAttributeOrSetter(Class_ $class): ?ConstFetch
    {
        $commandHidden = null;
        $classMethod = $class->getMethod('configure');
        if (! $classMethod instanceof ClassMethod) {
            return $this->resolveHiddenFromAttribute($class);
        }
        $this->simpleCallableNodeTraverser->traverseNodesWithCallable(
            (array) $classMethod->stmts,
            function (Node $node) use (&$commandHidden) {
                if (! $node instanceof MethodCall) {
                    return null;
                }

                if (! $this->isSetHiddenMethodCall($node)) {
                    return null;
                }

                $commandHidden = $this->getCommandHiddenValue($node);

                $parentNode = $node->getAttribute(AttributeKey::PARENT_NODE);
                if ($parentNode instanceof MethodCall) {
                    $parentNode->var = $node->var;
                } else {
                    $this->nodeRemover->removeNode($node);
                }

                return NodeTraverser::STOP_TRAVERSAL;
            }
        );

        return $commandHidden;
    }

    public function getCommandHiddenValue(MethodCall $methodCall): ?ConstFetch
    {
        if (! isset($methodCall->args[0])) {
            return new ConstFetch(new Name('true'));
        }

        /** @var Arg $arg */
        $arg = $methodCall->args[0];
        if (! $arg->value instanceof ConstFetch) {
            return null;
        }

        return $arg->value;
    }

    public function isSetHiddenMethodCall(MethodCall $node): bool
    {
        if (! $this->nodeNameResolver->isName($node->name, 'setHidden')) {
            return false;
        }

        if (! $this->nodeTypeResolver->isObjectType(
            $node->var,
            new ObjectType('Symfony\Component\Console\Command\Command')
        )) {
            return false;
        }

        return true;
    }

    private function resolveHiddenFromAttribute(Class_ $class): ?ConstFetch
    {
        $commandHidden = null;
        if ($this->phpAttributeAnalyzer->hasPhpAttribute($class, SymfonyAnnotation::AS_COMMAND)) {
            $commandHiddenFromArgument = $this->attributeValueResolver->getArgumentValueFromAttribute($class, 3);
            if ($commandHiddenFromArgument instanceof ConstFetch) {
                $commandHidden = $commandHiddenFromArgument;
            }
        }

        return $commandHidden;
    }
}
