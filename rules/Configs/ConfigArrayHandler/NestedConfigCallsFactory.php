<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\ConfigArrayHandler;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\Expression;
use Rector\PhpParser\Node\NodeFactory;

final class NestedConfigCallsFactory
{
    public function __construct(
        private readonly NodeFactory $nodeFactory
    ) {
    }

    /**
     * @param mixed[] $values
     * @return array<Expression<MethodCall>>
     */
    public function create(array $values, Variable|MethodCall $configVariable, string $mainMethodName): array
    {
        unset($values[0]);

        $methodCallStmts = [];

        foreach ($values as $value) {
            if (is_array($value)) {
                // doctrine
                if ($mainMethodName === 'connections') {
                    foreach ($value as $connectionName => $connectionConfiguration) {
                        $connectionArgs = $this->nodeFactory->createArgs([$connectionName]);
                        $connectionMethodCall = new MethodCall($configVariable, 'connection', $connectionArgs);

                        foreach ($connectionConfiguration as $configurationMethod => $configurationValue) {
                            $args = $this->nodeFactory->createArgs([$configurationValue]);
                            $connectionMethodCall = new MethodCall($connectionMethodCall, $configurationMethod, $args);
                        }

                        $methodCallStmts[] = new Expression($connectionMethodCall);
                    }

                    continue;
                }

                $mainMethodCall = new MethodCall($configVariable, $mainMethodName);

                foreach ($value as $methodName => $parameters) {
                    // security
                    if ($methodName === 'role') {
                        $methodName = 'roles';
                        $parameters = [$parameters];
                    }

                    $args = $this->nodeFactory->createArgs([$parameters]);

                    $mainMethodCall = new MethodCall($mainMethodCall, $methodName, $args);
                }
            }

            $methodCallStmts[] = new Expression($mainMethodCall);
        }

        return $methodCallStmts;
    }
}
