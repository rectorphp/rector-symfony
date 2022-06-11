<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;

final class PropertyAndAnnotation
{
    public function __construct(
        private readonly string $property,
        private readonly DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
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
