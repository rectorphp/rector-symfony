<?php

declare(strict_types=1);

namespace Rector\Symfony;

use PhpParser\Node\Attribute;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\ValueObject\ConstantNameAndValue;

final class ConstantNameAndValueResolver
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private ConstantNameAndValueMatcher $constantNameAndValueMatcher
    ) {
    }

    /**
     * @param Attribute[] $routeAttributes
     * @return ConstantNameAndValue[]
     */
    public function resolveFromAttributes(array $routeAttributes, string $prefixForNumeric): array
    {
        $constantNameAndValues = [];

        foreach ($routeAttributes as $routeAttribute) {
            foreach ($routeAttribute->args as $arg) {
                if (! $this->nodeNameResolver->isName($arg, 'name')) {
                    continue;
                }

                $constantNameAndValue = $this->constantNameAndValueMatcher->matchFromArg($arg, $prefixForNumeric);
                if (! $constantNameAndValue instanceof ConstantNameAndValue) {
                    continue;
                }

                $constantNameAndValues[] = $constantNameAndValue;
            }
        }

        return $constantNameAndValues;
    }
}
