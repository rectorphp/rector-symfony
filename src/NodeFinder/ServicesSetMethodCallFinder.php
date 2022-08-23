<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFinder;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Stmt;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\Generic\GenericClassStringType;
use PHPStan\Type\ObjectType;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\Symfony\ValueObject\ServiceSetMethodCallMetadata;

final class ServicesSetMethodCallFinder
{
    public function __construct(
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly NodeTypeResolver $nodeTypeResolver
    ) {
    }

    /**
     * @param Stmt[] $stmts
     * @return ServiceSetMethodCallMetadata[]
     */
    public function find(array $stmts): array
    {
        /** @var MethodCall[] $setServiceMethodCalls */
        $setServiceMethodCalls = $this->betterNodeFinder->find($stmts, function (Node $node): bool {
            if (! $node instanceof MethodCall) {
                return false;
            }

            if (! $this->nodeNameResolver->isName($node->name, 'set')) {
                return false;
            }

            if (count($node->getArgs()) !== 2) {
                return false;
            }

            return $this->nodeTypeResolver->isObjectType(
                $node->var,
                new ObjectType('Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator')
            );
        });

        return $this->createSetServiceMethodCallMetadatas($setServiceMethodCalls);
    }

    private function resolveServiceType(Arg $arg): ?string
    {
        $secondArgType = $this->nodeTypeResolver->getType($arg->value);
        if ($secondArgType instanceof ConstantStringType) {
            return $secondArgType->getValue();
        }

        if ($secondArgType instanceof GenericClassStringType) {
            return $secondArgType->getReferencedClasses()[0];
        }

        return null;
    }

    /**
     * @param MethodCall[] $setServiceMethodCalls
     * @return ServiceSetMethodCallMetadata[]
     */
    private function createSetServiceMethodCallMetadatas(array $setServiceMethodCalls): array
    {
        $serviceSetMethodCallMetadatas = [];

        foreach ($setServiceMethodCalls as $setServiceMethodCall) {
            $args = $setServiceMethodCall->getArgs();
            $firstArg = $args[0];
            $secondArg = $args[1];

            $firstArgType = $this->nodeTypeResolver->getType($firstArg->value);
            if (! $firstArgType instanceof ConstantStringType) {
                continue;
            }

            $serviceName = $firstArgType->getValue();

            $serviceType = $this->resolveServiceType($secondArg);
            if (! is_string($serviceType)) {
                continue;
            }

            $serviceSetMethodCallMetadatas[] = new ServiceSetMethodCallMetadata(
                $setServiceMethodCall,
                $serviceName,
                $serviceType
            );
        }

        return $serviceSetMethodCallMetadatas;
    }
}
