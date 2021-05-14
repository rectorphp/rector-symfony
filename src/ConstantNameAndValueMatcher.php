<?php

declare(strict_types=1);

namespace Rector\Symfony;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr\ClassConstFetch;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\Symfony\ValueObject\ConstantNameAndValue;
use Stringy\Stringy;

final class ConstantNameAndValueMatcher
{
    public function __construct(
        private ValueResolver $valueResolver
    ) {
    }

    public function matchFromArg(Arg $arg, string $prefixForNumeric): ?ConstantNameAndValue
    {
        if ($arg->value instanceof ClassConstFetch) {
            return null;
        }

        $argumentValue = $this->valueResolver->getValue($arg->value);
        if (! is_string($argumentValue)) {
            return null;
        }

        $stringy = new Stringy($argumentValue);
        $constantName = (string) $stringy->underscored()
            ->toUpperCase();

        if (! ctype_alpha($constantName[0])) {
            $constantName = $prefixForNumeric . $constantName;
        }

        return new ConstantNameAndValue($constantName, $argumentValue);
    }
}
