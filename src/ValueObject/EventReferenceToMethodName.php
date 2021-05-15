<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr\ClassConstFetch;
use Rector\Symfony\Contract\EventReferenceToMethodNameInterface;

final class EventReferenceToMethodName implements EventReferenceToMethodNameInterface
{
    public function __construct(
        private ClassConstFetch $classConstFetch,
        private string $methodName
    ) {
    }

    public function getClassConstFetch(): ClassConstFetch
    {
        return $this->classConstFetch;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }
}
