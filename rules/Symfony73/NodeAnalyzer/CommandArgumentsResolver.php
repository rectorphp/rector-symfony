<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeAnalyzer;

use PhpParser\Node\Stmt\ClassMethod;
use Rector\Symfony\Symfony73\NodeFinder\MethodCallFinder;
use Rector\Symfony\Symfony73\ValueObject\CommandArgument;

final readonly class CommandArgumentsResolver
{
    public function __construct(
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

            $commandArguments[] = new CommandArgument(
                $addArgumentArgs[0]->value,
                $addArgumentArgs[1]->value ?? null,
                $addArgumentArgs[2]->value ?? null,
            );
        }

        return $commandArguments;
    }
}
