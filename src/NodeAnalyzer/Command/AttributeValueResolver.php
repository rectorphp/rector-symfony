<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer\Command;

use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Symfony\Enum\SymfonyAnnotation;

final class AttributeValueResolver
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver,
    ) {
    }

    public function getArgumentValueFromAttribute(Class_ $class, int $argumentIndexKey): string|ConstFetch|Array_|null
    {
        foreach ($class->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attribute) {
                if (! $this->nodeNameResolver->isName($attribute->name, SymfonyAnnotation::AS_COMMAND)) {
                    continue;
                }

                if (! isset($attribute->args[$argumentIndexKey])) {
                    continue;
                }

                $arg = $attribute->args[$argumentIndexKey];
                if ($arg->value instanceof String_) {
                    return $arg->value->value;
                } elseif ($arg->value instanceof ConstFetch || $arg->value instanceof Array_) {
                    return $arg->value;
                }
            }
        }

        return null;
    }
}
