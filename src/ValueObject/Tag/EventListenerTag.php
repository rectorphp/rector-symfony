<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\Tag;

use Rector\Symfony\Contract\Tag\TagInterface;

final readonly class EventListenerTag implements TagInterface
{
    public function __construct(
        private string $event,
        private string $method,
        private int $priority
    ) {
    }

    public function getName(): string
    {
        return 'kernel.event_listener';
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return [
            'method' => $this->method,
            'priority' => $this->priority,
            'event' => $this->event,
        ];
    }
}
