<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory;

use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use Rector\NodeManipulator\FuncCallManipulator;

final readonly class ArrayFromCompactFactory
{
    public function __construct(
        private FuncCallManipulator $funcCallManipulator
    ) {
    }

    public function createArrayFromCompactFuncCall(FuncCall $compactFuncCall): Array_
    {
        $compactVariableNames = $this->funcCallManipulator->extractArgumentsFromCompactFuncCalls([$compactFuncCall]);

        $array = new Array_();
        foreach ($compactVariableNames as $compactVariableName) {
            $arrayItem = new ArrayItem(new Variable($compactVariableName), new String_($compactVariableName));
            $array->items[] = $arrayItem;
        }

        return $array;
    }
}
