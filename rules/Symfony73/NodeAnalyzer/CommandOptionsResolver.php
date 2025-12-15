<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeAnalyzer;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Type\Type;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\Symfony73\NodeFinder\MethodCallFinder;
use Rector\Symfony\Symfony73\ValueObject\CommandOption;

final readonly class CommandOptionsResolver
{
    public function __construct(
        private MethodCallFinder $methodCallFinder,
        private ValueResolver $valueResolver,
        private NodeTypeResolver $nodeTypeResolver
    ) {
    }

    /**
     * @return CommandOption[]
     */
    public function resolve(ClassMethod $configureClassMethod): array
    {
        $addOptionMethodCalls = $this->methodCallFinder->find($configureClassMethod, 'addOption');

        $commandOptions = [];

        foreach ($addOptionMethodCalls as $addOptionMethodCall) {
            $optionName = $this->valueResolver->getValue($addOptionMethodCall->getArg('name', 0)?->value);
            $isImplicitBoolean = $this->isImplicitBoolean($addOptionMethodCall);

            $commandOptions[] = new CommandOption(
                $optionName,
                $addOptionMethodCall->getArg('name', 0)?->value,
                $addOptionMethodCall->getArg('shortcut', 1)?->value,
                $addOptionMethodCall->getArg('mode', 2)?->value,
                $addOptionMethodCall->getArg('description', 3)?->value,
                $addOptionMethodCall->getArg('default', 4)?->value,
                $this->isArrayMode($addOptionMethodCall),
                $isImplicitBoolean,
                $this->resolveDefaultType($addOptionMethodCall)
            );
        }

        return $commandOptions;
    }

    private function resolveDefaultType(MethodCall $methodCall): ?Type
    {
        $defaultArg = $methodCall->getArg('default', 4) ?? null;
        if (! $defaultArg instanceof Arg) {
            return null;
        }

        return $this->nodeTypeResolver->getType($defaultArg->value);
    }

    private function isArrayMode(MethodCall $methodCall): bool
    {
        $modeExpr = $methodCall->getArg('mode', 2)?->value;
        if (! $modeExpr instanceof Expr) {
            return false;
        }

        $modeValue = $this->valueResolver->getValue($modeExpr);
        // binary check for InputOption::VALUE_IS_ARRAY
        return (bool) ($modeValue & 8);
    }

    private function isImplicitBoolean(MethodCall $methodCall): bool
    {
        $modeExpr = $methodCall->getArg('mode', 2)?->value;
        if (! $modeExpr instanceof Expr) {
            return false;
        }

        $modeValue = $this->valueResolver->getValue($modeExpr);
        // binary check for InputOption::VALUE_NONE
        return (bool) ($modeValue & 1);
    }
}
