<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

final class EventNameToClassAndConstant
{
    public function __construct(
        private string $eventName,
        private string $eventClass,
        private string $eventConstant
    ) {
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getEventClass(): string
    {
        return $this->eventClass;
    }

    public function getEventConstant(): string
    {
        return $this->eventConstant;
    }
}
