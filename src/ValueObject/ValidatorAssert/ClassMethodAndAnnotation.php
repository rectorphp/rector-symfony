<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\ValidatorAssert;

use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;

final class ClassMethodAndAnnotation
{
    /**
     * @param string[] $possibleMethodNames
     */
    public function __construct(
        private readonly array $possibleMethodNames,
        private readonly DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ) {
    }

    /**
     * @return string[]
     */
    public function getPossibleMethodNames(): array
    {
        return $this->possibleMethodNames;
    }

    public function getDoctrineAnnotationTagValueNode(): DoctrineAnnotationTagValueNode
    {
        return $this->doctrineAnnotationTagValueNode;
    }
}
