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
        private ValueResolver $valueResolver,
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
            $variableName = $this->createCamelCase($commandArgument->getNameValue());
            $argumentParam = new Param(new Variable($variableName));

            if ($commandArgument->isArray()) {
                $argumentParam->type = new Identifier('array');
            } else {
                $argumentParam->type = new Identifier('string');
            }

            if ($commandArgument->getDefault() instanceof Expr) {
                $argumentParam->default = $commandArgument->getDefault();
            }

            if ($this->isOptionalArgument($commandArgument)) {
                $argumentParam->type = new NullableType($argumentParam->type);
            }

            // @todo default string, multiple values array

            $argumentArgs = [new Arg(value: $commandArgument->getName(), name: new Identifier('name'))];

            if ($this->isNonEmptyExpr($commandArgument->getDescription())) {
                $argumentArgs[] = new Arg(value: $commandArgument->getDescription(), name: new Identifier(
                    'description'
                ));
            }

            $argumentParam->attrGroups[] = new AttributeGroup([
                new Attribute(new FullyQualified(SymfonyAttribute::COMMAND_ARGUMENT), $argumentArgs),
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
            $variableName = $this->createCamelCase($commandOption->getNameValue());
            $optionParam = new Param(new Variable($variableName));

            if ($commandOption->getDefault() instanceof Expr) {
                $optionParam->default = $commandOption->getDefault();
            }

            $optionArgs = [new Arg(value: $commandOption->getName(), name: new Identifier('name'))];

            if ($this->isNonEmptyExpr($commandOption->getShortcut())) {
                $optionArgs[] = new Arg(value: $commandOption->getShortcut(), name: new Identifier('shortcut'));
            }

            if ($this->isNonEmptyExpr($commandOption->getMode())) {
                $optionArgs[] = new Arg(value: $commandOption->getMode(), name: new Identifier('mode'));
            }

            if ($this->isNonEmptyExpr($commandOption->getDescription())) {
                $optionArgs[] = new Arg(value: $commandOption->getDescription(), name: new Identifier('description'));
            }

            $optionParam->attrGroups[] = new AttributeGroup([
                new Attribute(new FullyQualified(SymfonyAttribute::COMMAND_OPTION), $optionArgs),
            ]);

            $optionParams[] = $optionParam;
        }

        return $optionParams;
    }

    private function createCamelCase(string $value): string
    {
        // Replace dashes/underscores with spaces
        $value = str_replace(['-', '_'], ' ', strtolower($value));

        // Capitalize each word, then remove spaces
        $value = str_replace(' ', '', ucwords($value));

        // Lowercase first character to make it camelCase
        return lcfirst($value);
    }

    private function isOptionalArgument(CommandArgument $commandArgument): bool
    {
        if (! $commandArgument->getMode() instanceof Expr) {
            return true;
        }

        return $this->valueResolver->isValue($commandArgument->getMode(), 2);
    }

    private function isNonEmptyExpr(?Expr $expr): bool
    {
        if (! $expr instanceof Expr) {
            return false;
        }

        if ($this->valueResolver->isNull($expr)) {
            return false;
        }

        return ! $this->valueResolver->isValue($expr, '');
    }
}
