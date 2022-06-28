<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory\Annotations;

use Rector\BetterPhpDocParser\ValueObject\PhpDoc\DoctrineAnnotation\CurlyListNode;

final class ValueQuoteWrapper
{
    /**
     * @return mixed|CurlyListNode|string
     */
    public function wrap(mixed $value): mixed
    {
        if (is_string($value)) {
            return '"' . $value . '"';
        }

        if (is_array($value)) {
            return $this->wrapArray($value);
        }

        return $value;
    }

    /**
     * @param mixed[] $value
     */
    private function wrapArray(array $value): CurlyListNode
    {
        $wrappedValue = [];

        foreach ($value as $nestedKey => $nestedValue) {
            $key = match (true) {
                is_numeric($nestedKey) => $nestedKey,
                default => '"' . $nestedKey . '"',
            };

            $wrappedValue[$key] = match (true) {
                is_string($nestedValue) => '"' . $nestedValue . '"',
                default => $nestedValue,
            };
        }

        return new CurlyListNode($wrappedValue);
    }
}
