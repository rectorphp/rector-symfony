<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;

final class ClassMethodAndAnnotation
{
    public function __construct(
        private readonly string $methodName,
        private readonly DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ) {
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function getDoctrineAnnotationTagValueNode(): DoctrineAnnotationTagValueNode
    {
        return $this->doctrineAnnotationTagValueNode;
    }
}
