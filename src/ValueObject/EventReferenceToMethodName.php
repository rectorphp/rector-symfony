<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr\ClassConstFetch;
use Rector\Symfony\Contract\EventReferenceToMethodNameInterface;

final class EventReferenceToMethodName implements EventReferenceToMethodNameInterface
{
    public function __construct(
        private readonly ClassConstFetch $classConstFetch,
        private readonly string $methodName
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
