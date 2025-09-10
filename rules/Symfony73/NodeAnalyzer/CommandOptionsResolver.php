<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeAnalyzer;

use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Exception\ShouldNotHappenException;
use Rector\Symfony\Symfony73\NodeFinder\MethodCallFinder;
use Rector\Symfony\Symfony73\ValueObject\CommandOption;

final readonly class CommandOptionsResolver
{
    public function __construct(
        private MethodCallFinder $methodCallFinder,
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

            $nameArgValue = $addOptionArgs[0]->value;
            if (! $nameArgValue instanceof String_) {
                // we need string value, otherwise param will not have a name
                throw new ShouldNotHappenException('Option name is required');
            }

            $shortcutExpr = $addOptionArgs[1]?->value ?? null;
            $modeExpr = $addOptionArgs[2]?->value ?? null;
            $descriptionExpr = $addOptionArgs[3]?->value ?? null;

            $commandOptions[] = new CommandOption($nameArgValue, $shortcutExpr, $modeExpr, $descriptionExpr);
        }

        return $commandOptions;
    }
}
