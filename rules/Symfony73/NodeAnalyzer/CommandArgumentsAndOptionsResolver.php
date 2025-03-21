<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeFinder;
use Rector\Exception\ShouldNotHappenException;
use Rector\Symfony\Symfony73\ValueObject\CommandOptionMetadata;

final class CommandArgumentsAndOptionsResolver
{
    /**
     * @return CommandOptionMetadata[]
     */
    public function collectCommandOptionsMetadatas(ClassMethod $configureClassMethod): array
    {
        $addOptionMethodCalls = $this->findMethodCallsByName($configureClassMethod, 'addOption');

        $commandOptionMetadatas = [];

        foreach ($addOptionMethodCalls as $addOptionMethodCall) {
            // @todo extract name, type and requirements
            $addOptionArgs = $addOptionMethodCall->getArgs();

            $nameArgValue = $addOptionArgs[0]->value;
            if (! $nameArgValue instanceof String_) {
                // we need string value, otherwise param will not have a name
                throw new ShouldNotHappenException('Option name is required');
            }

            $optionName = $nameArgValue->value;

            $commandOptionMetadatas[] = new CommandOptionMetadata($optionName);
        }

        return $commandOptionMetadatas;
    }

    /**
     * @return MethodCall[]
     */
    private function findMethodCallsByName(ClassMethod $classMethod, string $desiredMethodName): array
    {
        $nodeFinder = new NodeFinder();

        return $nodeFinder->find($classMethod, function (Node $node) use ($desiredMethodName): bool {
            if (! $node instanceof MethodCall) {
                return false;
            }

            if (! $node->name instanceof Node\Identifier) {
                return false;
            }

            return $node->name->toString() === $desiredMethodName;
        });
    }
}
