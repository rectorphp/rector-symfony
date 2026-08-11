<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

use PhpParser\Node\Expr\Array_;

final readonly class GetMethodConversions
{
    /**
     * @param AsTwigAttributeConversion[] $asTwigAttributeConversions
     */
    public function __construct(
        private string $methodName,
        private string $attributeClass,
        private Array_ $returnArray,
        private array $asTwigAttributeConversions
    ) {
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function getAttributeClass(): string
    {
        return $this->attributeClass;
    }

    public function getReturnArray(): Array_
    {
        return $this->returnArray;
    }

    /**
     * @return AsTwigAttributeConversion[]
     */
    public function getAsTwigAttributeConversions(): array
    {
        return $this->asTwigAttributeConversions;
    }
}
