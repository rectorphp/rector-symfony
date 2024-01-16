<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\ConfigArrayHandler;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Expression;
use Rector\Exception\ShouldNotHappenException;

final class SecurityAccessControlConfigArrayHandler
{
    /**
     * @return array<Expression<MethodCall>>
     */
    public function handle(Array_ $array, Variable $configVariable): array
    {
        if (! $array->items[0] instanceof ArrayItem) {
            return [];
        }

        $nestedAccessControlArrayItem = $array->items[0];
        $nestedAccessControlArray = $nestedAccessControlArrayItem->value;

        if (! $nestedAccessControlArray instanceof Array_) {
            return [];
        }

        $methodCallStmts = [];
        foreach ($nestedAccessControlArray->items as $accessControlArrayItem) {
            if (! $accessControlArrayItem instanceof ArrayItem) {
                throw new ShouldNotHappenException();
            }

            $nestedAccessControlArrayArray = $accessControlArrayItem->value;
            if (! $nestedAccessControlArrayArray instanceof Array_) {
                return [];
            }

            // build accessControl() method call here
            $accessControlMethodCall = new MethodCall($configVariable, 'accessControl');

            $accessControlMethodCall = $this->decoreateAccessControlArrayArray(
                $nestedAccessControlArrayArray,
                $accessControlMethodCall
            );

            $methodCallStmts[] = new Expression($accessControlMethodCall);
        }

        return $methodCallStmts;
    }

    private function decoreateAccessControlArrayArray(
        Array_ $nestedAccessControlArrayArray,
        MethodCall $accessControlMethodCall
    ): MethodCall {
        foreach ($nestedAccessControlArrayArray->items as $nestedAccessControlArrayArrayItem) {
            if (! $nestedAccessControlArrayArrayItem instanceof ArrayItem) {
                throw new ShouldNotHappenException();
            }

            if ($nestedAccessControlArrayArrayItem->key instanceof String_) {
                $methodName = $nestedAccessControlArrayArrayItem->key->value;

                $argValue = $nestedAccessControlArrayArrayItem->value;

                // method correction
                if ($methodName === 'role') {
                    $methodName = 'roles';
                    $argValue = new Array_([new ArrayItem($argValue)]);
                }

                $accessControlMethodCall = new MethodCall(
                    $accessControlMethodCall,
                    $methodName,
                    [new Arg($argValue)]
                );
            }
        }

        return $accessControlMethodCall;
    }
}
