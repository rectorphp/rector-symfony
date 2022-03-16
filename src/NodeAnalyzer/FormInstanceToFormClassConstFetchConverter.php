<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use PHPStan\Reflection\ReflectionProvider;
use Rector\Core\PhpParser\Node\NodeFactory;
use ReflectionMethod;

final class FormInstanceToFormClassConstFetchConverter
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
        private NodeFactory $nodeFactory
    ) {
    }

    public function processNewInstance(MethodCall $methodCall, int $position, int $optionsPosition): ?Node
    {
        $args = $methodCall->getArgs();
        if (! isset($args[$position])) {
            return null;
        }

        $argValue = $args[$position]->value;
        if (! $argValue instanceof New_) {
            return null;
        }

        // we can only process direct name
        if (! $argValue->class instanceof Name) {
            return null;
        }

        if ($argValue->args !== []) {
            $methodCall = $this->moveArgumentsToOptions(
                $methodCall,
                $position,
                $optionsPosition,
                $argValue->class->toString(),
                $argValue->getArgs()
            );

            if (! $methodCall instanceof MethodCall) {
                return null;
            }
        }

        $currentArg = $methodCall->getArgs()[$position];

        $classConstReference = $this->nodeFactory->createClassConstReference($argValue->class->toString());
        $currentArg->value = $classConstReference;

        return $methodCall;
    }

    /**
     * @param Arg[] $argNodes
     */
    private function moveArgumentsToOptions(
        MethodCall $methodCall,
        int $position,
        int $optionsPosition,
        string $className,
        array $argNodes
    ): ?MethodCall {
        $namesToArgs = $this->resolveNamesToArgs($className, $argNodes);

        // set default data in between
        if ($position + 1 !== $optionsPosition && ! isset($methodCall->args[$position + 1])) {
            $methodCall->args[$position + 1] = new Arg($this->nodeFactory->createNull());
        }

        // @todo decopule and name, so I know what it is
        if (! isset($methodCall->args[$optionsPosition])) {
            $array = new Array_();
            foreach ($namesToArgs as $name => $arg) {
                $array->items[] = new ArrayItem($arg->value, new String_($name));
            }

            $methodCall->args[$optionsPosition] = new Arg($array);
        }

        if (! $this->reflectionProvider->hasClass($className)) {
            return null;
        }

        $formTypeClassReflection = $this->reflectionProvider->getClass($className);
        if (! $formTypeClassReflection->hasConstructor()) {
            return null;
        }

        // nothing we can do, out of scope
        return $methodCall;
    }

    /**
     * @param Arg[] $args
     * @return array<string, Arg>
     */
    private function resolveNamesToArgs(string $className, array $args): array
    {
        if (! $this->reflectionProvider->hasClass($className)) {
            return [];
        }

        $classReflection = $this->reflectionProvider->getClass($className);
        $reflectionClass = $classReflection->getNativeReflection();

        $constructorReflectionMethod = $reflectionClass->getConstructor();
        if (! $constructorReflectionMethod instanceof ReflectionMethod) {
            return [];
        }

        $namesToArgs = [];
        foreach ($constructorReflectionMethod->getParameters() as $position => $reflectionParameter) {
            $namesToArgs[$reflectionParameter->getName()] = $args[$position];
        }

        return $namesToArgs;
    }
}
