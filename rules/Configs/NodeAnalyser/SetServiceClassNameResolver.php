<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\NodeAnalyser;

use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\NodeFinder;

final class SetServiceClassNameResolver
{
    /**
     * Looks for
     *
     * $services->set(SomeClassName::Class)
     *
     * ↓
     * "SomeClassName"
     */
    public function resolve(MethodCall $methodCall): ?string
    {
        $nodeFinder = new NodeFinder();

        $serviceClassName = null;
        $nodeFinder->findFirst($methodCall, function (Node $node) use (&$serviceClassName): ?bool {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $node->name instanceof Identifier) {
                return null;
            }

            // we look for services variable
            if (! $node->var instanceof Variable) {
                return null;
            }

            if (! is_string($node->var->name)) {
                return null;
            }

            $servicesName = $node->var->name;
            if ($servicesName !== 'services') {
                return null;
            }

            // dump($methodCall->var);
            $args = $node->getArgs();
            foreach ($args as $arg) {
                if (! $arg->value instanceof ClassConstFetch) {
                    continue;
                }

                $classConstFetch = $arg->value;
                if (! $classConstFetch->name instanceof Identifier) {
                    continue;
                }

                if ($classConstFetch->name->toString() !== 'class') {
                    continue;
                }

                if (! $classConstFetch->class instanceof FullyQualified) {
                    continue;
                }

                $serviceClassName = $classConstFetch->class->toString();
                return true;
            }

            return false;
        });

        return $serviceClassName;
    }
}
