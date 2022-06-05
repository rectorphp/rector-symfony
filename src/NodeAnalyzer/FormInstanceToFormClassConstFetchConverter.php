<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Scalar\String_;
use PHPStan\Reflection\ReflectionProvider;
use Rector\Core\PhpParser\Node\NodeFactory;
use ReflectionMethod;

final class FormInstanceToFormClassConstFetchConverter
{
    public function __construct(
        private readonly ReflectionProvider $reflectionProvider,
        private readonly NodeFactory $nodeFactory,
        private \Rector\Symfony\NodeAnalyzer\FormType\FormTypeClassResolver $formTypeClassResolver,
    ) {
    }

    public function processNewInstance(MethodCall $methodCall, int $position, int $optionsPosition): ?Node
    {
        $args = $methodCall->getArgs();
        if (! isset($args[$position])) {
            return null;
        }

        $argValue = $args[$position]->value;

        $formClassName = $this->formTypeClassResolver->resolveFromExpr($argValue);
        if ($formClassName === null) {
            return null;
        }

        if ($argValue instanceof New_ && $argValue->args !== []) {
            $methodCall = $this->moveArgumentsToOptions(
                $methodCall,
                $position,
                $optionsPosition,
                $formClassName,
                $argValue->getArgs()
            );
            if (! $methodCall instanceof MethodCall) {
                return null;
            }
        }

        $currentArg = $methodCall->getArgs()[$position];

        dump_node($currentArg);
        die;

        $classConstFetch = $this->nodeFactory->createClassConstReference($formClassName);
        $currentArg->value = $classConstFetch;

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
        $nativeReflection = $classReflection->getNativeReflection();

        $constructorReflectionMethod = $nativeReflection->getConstructor();
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
