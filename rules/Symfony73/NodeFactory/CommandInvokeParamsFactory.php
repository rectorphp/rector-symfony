<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeFactory;

use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\NullableType;
use PhpParser\Node\Param;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\Enum\SymfonyAttribute;
use Rector\Symfony\Symfony73\ValueObject\CommandArgument;
use Rector\Symfony\Symfony73\ValueObject\CommandOption;

final readonly class CommandInvokeParamsFactory
{
    public function __construct(
        private ValueResolver $valueResolver
    ) {
    }

    /**
     * @param CommandArgument[] $commandArguments
     * @param CommandOption[] $commandOptions
     * @return Param[]
     */
    public function createParams(array $commandArguments, array $commandOptions): array
    {
        $argumentParams = $this->createArgumentParams($commandArguments);
        $optionParams = $this->createOptionParams($commandOptions);

        return array_merge($argumentParams, $optionParams);
    }

    /**
     * @param CommandArgument[] $commandArguments
     * @return Param[]
     */
    private function createArgumentParams(array $commandArguments): array
    {
        $argumentParams = [];

        foreach ($commandArguments as $commandArgument) {
            $argumentName = (string) $this->valueResolver->getValue($commandArgument->getName());
            $variableName = str_replace('-', '_', $argumentName);

            $argumentParam = new Param(new Variable($variableName));

            $argumentParam->type = new Identifier('string');

            $modeValue = $this->valueResolver->getValue($commandArgument->getMode());
            if ($modeValue === null || $modeValue === 2) {
                $argumentParam->type = new NullableType($argumentParam->type);
            }

            // @todo fill type or default value
            // @todo default string, multiple values array

            $argumentParam->attrGroups[] = new AttributeGroup([
                new Attribute(
                    new FullyQualified(SymfonyAttribute::COMMAND_ARGUMENT),
                    [
                        new Arg(value: $commandArgument->getName(), name: new Identifier('name')),
                        new Arg(value: $commandArgument->getDescription(), name: new Identifier('description')),
                    ]
                ),
            ]);

            $argumentParams[] = $argumentParam;
        }

        return $argumentParams;
    }

    /**
     * @param CommandOption[] $commandOptions
     * @return Param[]
     */
    private function createOptionParams(array $commandOptions): array
    {
        $optionParams = [];

        foreach ($commandOptions as $commandOption) {
            $optionName = $commandOption->getStringName();
            $variableName = str_replace('-', '_', $optionName);

            $optionParam = new Param(new Variable($variableName));

            $optionArgs = [new Arg(value: $commandOption->getName(), name: new Identifier('name'))];

            if ($commandOption->getShortcut() instanceof Expr) {
                $optionArgs[] = new Arg(value: $commandOption->getShortcut(), name: new Identifier('shortcut'));
            }

            if ($commandOption->getMode() instanceof Expr) {
                $optionArgs[] = new Arg(value: $commandOption->getMode(), name: new Identifier('mode'));
            }

            if ($commandOption->getDescription() instanceof Expr) {
                $optionArgs[] = new Arg(value: $commandOption->getDescription(), name: new Identifier('description'));
            }

            $optionParam->attrGroups[] = new AttributeGroup([
                new Attribute(new FullyQualified(SymfonyAttribute::COMMAND_OPTION), $optionArgs),
            ]);

            $optionParams[] = $optionParam;
        }

        return $optionParams;
    }
}
