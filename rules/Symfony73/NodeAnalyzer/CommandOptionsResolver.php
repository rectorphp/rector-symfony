<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeAnalyzer;

use PhpParser\Node\Stmt\ClassMethod;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\Symfony73\NodeFinder\MethodCallFinder;
use Rector\Symfony\Symfony73\ValueObject\CommandOption;

final readonly class CommandOptionsResolver
{
    public function __construct(
        private MethodCallFinder $methodCallFinder,
        private ValueResolver $valueResolver
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
            $addOptionArgs = $addOptionMethodCall->getArgs();

            $optionName = $this->valueResolver->getValue($addOptionArgs[0]->value);

            $commandOptions[] = new CommandOption(
                $optionName,
                $addOptionArgs[0]->value,
                $addOptionArgs[1]->value ?? null,
                $addOptionArgs[2]->value ?? null,
                $addOptionArgs[3]->value ?? null,
                $addOptionArgs[4]->value ?? null
            );
        }

        return $commandOptions;
    }
}
