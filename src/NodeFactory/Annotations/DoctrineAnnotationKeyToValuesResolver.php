<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory\Annotations;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use Rector\BetterPhpDocParser\ValueObject\PhpDoc\DoctrineAnnotation\CurlyListNode;
use Rector\Core\PhpParser\Node\Value\ValueResolver;

final class DoctrineAnnotationKeyToValuesResolver
{
    public function __construct(
        private readonly ValueResolver $valueResolver
    ) {
    }

    /**
     * @return array<string|null, mixed>
     */
    public function resolveFromExpr(Expr $expr): array
    {
        $annotationKeyToValues = [];

        if ($expr instanceof Array_) {
            foreach ($expr->items as $arrayItem) {
                if (! $arrayItem instanceof ArrayItem) {
                    continue;
                }

                $key = $this->resolveKey($arrayItem);

                $value = $this->valueResolver->getValue($arrayItem->value);
                $value = $this->wrapStringValuesInQuotes($value, $key);

                $annotationKeyToValues[$key] = $value;
            }
        }

        return $annotationKeyToValues;
    }

    private function resolveKey(ArrayItem $arrayItem): ?string
    {
        if (! $arrayItem->key instanceof Expr) {
            return null;
        }

        return $this->valueResolver->getValue($arrayItem->key);
    }

    /**
     * @return mixed|CurlyListNode|string
     */
    private function wrapStringValuesInQuotes(mixed $value, ?string $key): mixed
    {
        if (is_string($value)) {
            return '"' . $value . '"';
        }

        if (is_array($value)) {
            // include quotes in groups
            if ($key === 'groups') {
                foreach ($value as $nestedKey => $nestedValue) {
                    $value[$nestedKey] = '"' . $nestedValue . '"';
                }
            }

            return new CurlyListNode($value);
        }

        return $value;
    }
}
