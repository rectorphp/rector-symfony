<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr\ClassConstFetch;
use Rector\Symfony\Contract\EventReferenceToMethodNameInterface;

final class EventReferenceToMethodNameWithPriority implements EventReferenceToMethodNameInterface
{
    public function __construct(
        private ClassConstFetch $classConstFetch,
        private string $methodName,
        private int $priority
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

    public function getPriority(): int
    {
        return $this->priority;
    }
}
