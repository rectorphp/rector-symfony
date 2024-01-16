<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\ValidatorAssert;

use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;

final readonly class PropertyAndAnnotation
{
    public function __construct(
        private string $property,
        private DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ) {
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getDoctrineAnnotationTagValueNode(): DoctrineAnnotationTagValueNode
    {
        return $this->doctrineAnnotationTagValueNode;
    }
}
