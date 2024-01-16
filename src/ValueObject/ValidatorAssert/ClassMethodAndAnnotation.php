<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\ValidatorAssert;

use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;

final readonly class ClassMethodAndAnnotation
{
    /**
     * @param string[] $possibleMethodNames
     */
    public function __construct(
        private array $possibleMethodNames,
        private DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
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
