<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeAnalyzer;

use PHPStan\Type\Type;
use PhpParser\Node\Arg;
use PhpParser\Node\Stmt\ClassMethod;
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
            $addOptionArgs = $addOptionMethodCall->getArgs();

            $optionName = $this->valueResolver->getValue($addOptionArgs[0]->value);

            $commandOptions[] = new CommandOption(
                $optionName,
                $addOptionArgs[0]->value,
                $addOptionArgs[1]->value ?? null,
                $addOptionArgs[2]->value ?? null,
                $addOptionArgs[3]->value ?? null,
                $addOptionArgs[4]->value ?? null,
                $this->resolveDefaultType($addOptionArgs)
            );
        }

        return $commandOptions;
    }

    /**
     * @param Arg[] $args
     */
    private function resolveDefaultType(array $args): ?Type
    {
        $defaultArg = $args[4] ?? null;
        if (! $defaultArg instanceof Arg) {
            return null;
        }

        return $this->nodeTypeResolver->getType($defaultArg->value);
    }
}
