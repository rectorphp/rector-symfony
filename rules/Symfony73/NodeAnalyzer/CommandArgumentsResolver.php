<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Exception\ShouldNotHappenException;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\Symfony73\NodeFinder\MethodCallFinder;
use Rector\Symfony\Symfony73\ValueObject\CommandArgument;

final readonly class CommandArgumentsResolver
{
    public function __construct(
        private ValueResolver $valueResolver,
        private MethodCallFinder $methodCallFinder,
    ) {
    }

    /**
     * @return CommandArgument[]
     */
    public function resolve(ClassMethod $configureClassMethod): array
    {
        $addArgumentMethodCalls = $this->methodCallFinder->find($configureClassMethod, 'addArgument');

        $commandArguments = [];
        foreach ($addArgumentMethodCalls as $addArgumentMethodCall) {
            $addArgumentArgs = $addArgumentMethodCall->getArgs();

            $optionName = $this->valueResolver->getValue($addArgumentArgs[0]->value);
            if ($optionName === null) {
                // we need string value, otherwise param will not have a name
                throw new ShouldNotHappenException('Argument name is required');
            }

            $argumentModeExpr = $this->resolveArgumentModeExpr($addArgumentArgs);
            $argumentDescriptionExpr = $this->resolveArgumentDescriptionExpr($addArgumentArgs);

            $commandArguments[] = new CommandArgument(
                $addArgumentArgs[0]->value,
                $argumentModeExpr,
                $argumentDescriptionExpr
            );
        }

        return $commandArguments;
    }

    /**
     * @param Node\Arg[] $addArgumentArgs
     */
    private function resolveArgumentModeExpr(array $addArgumentArgs): ?Expr
    {
        if (! isset($addArgumentArgs[1])) {
            return null;
        }

        $mode = $this->valueResolver->getValue($addArgumentArgs[1]->value);
        if ($mode !== null && ! is_numeric($mode)) {
            // we need numeric value or null, otherwise param will not have a name
            throw new ShouldNotHappenException('Argument mode is required to be null or numeric');
        }

        return $addArgumentArgs[1]->value;
    }

    /**
     * @param Node\Arg[] $addArgumentArgs
     */
    private function resolveArgumentDescriptionExpr(array $addArgumentArgs): ?Expr
    {
        if (! isset($addArgumentArgs[2])) {
            return null;
        }

        $description = $this->valueResolver->getValue($addArgumentArgs[2]->value);
        if (! is_string($description)) {
            // we need string value, otherwise param will not have a name
            throw new ShouldNotHappenException('Argument description is required');
        }

        return $addArgumentArgs[2]->value;
    }
}
