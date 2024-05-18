<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\ConfigArrayHandler;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\Expression;
use Rector\PhpParser\Node\NodeFactory;
use Rector\Symfony\Configs\Enum\GroupingMethods;
use Rector\Symfony\Configs\Enum\SecurityConfigKey;
use Rector\Symfony\Utils\StringUtils;
use Webmozart\Assert\Assert;

final readonly class NestedConfigCallsFactory
{
    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    /**
     * @param mixed[] $values
     * @return array<Expression<MethodCall>>
     */
    public function create(array $values, Variable|MethodCall $configCaller, string $mainMethodName): array
    {
        $methodCallStmts = [];

        foreach ($values as $value) {
            if (is_array($value)) {
                // doctrine
                foreach (GroupingMethods::GROUPING_METHOD_NAME_TO_SPLIT as $groupingMethodName => $splitMethodName) {
                    if ($mainMethodName === $groupingMethodName) {
                        // @possibly here
                        foreach ($value as $connectionName => $connectionConfiguration) {
                            $connectionArgs = $this->nodeFactory->createArgs([$connectionName]);

                            $connectionMethodCall = new MethodCall($configCaller, $splitMethodName, $connectionArgs);

                            $connectionMethodCall = $this->createMainMethodCall(
                                $connectionConfiguration,
                                $connectionMethodCall
                            );

                            $methodCallStmts[] = new Expression($connectionMethodCall);
                        }

                        continue 2;
                    }
                }

                $mainMethodCall = new MethodCall($configCaller, $mainMethodName);
                $mainMethodCall = $this->createMainMethodCall($value, $mainMethodCall);

                $methodCallStmts[] = new Expression($mainMethodCall);
            }
        }

        return $methodCallStmts;
    }

    /**
     * @param array<mixed, mixed> $value
     */
    private function createMainMethodCall(array $value, MethodCall $mainMethodCall): MethodCall
    {
        foreach ($value as $methodName => $parameters) {
            // security
            if ($methodName === SecurityConfigKey::ROLE) {
                $methodName = SecurityConfigKey::ROLES;
                $parameters = [$parameters];
            } else {
                Assert::string($methodName);
                $methodName = StringUtils::underscoreToCamelCase($methodName);
            }

            if (isset(GroupingMethods::GROUPING_METHOD_NAME_TO_SPLIT[$methodName])) {
                $splitMethodName = GroupingMethods::GROUPING_METHOD_NAME_TO_SPLIT[$methodName];

                foreach ($parameters as $splitName => $splitParameters) {
                    $args = $this->nodeFactory->createArgs([$splitName]);
                    $mainMethodCall = new MethodCall($mainMethodCall, $splitMethodName, $args);

                    $mainMethodCall = $this->createMainMethodCall($splitParameters, $mainMethodCall);
                }

                continue;
            }

            // traverse nested arrays with recursion call
            if (is_array($parameters) && ! array_is_list($parameters)) {
                $mainMethodCall = new MethodCall($mainMethodCall, $methodName);
                $mainMethodCall = $this->createMainMethodCall($parameters, $mainMethodCall);

                continue;
            }

            $args = $this->nodeFactory->createArgs([$parameters]);
            $mainMethodCall = new MethodCall($mainMethodCall, $methodName, $args);
        }

        return $mainMethodCall;
    }
}
