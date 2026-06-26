<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source;

use Symfony\Contracts\EventDispatcher\Event;

final class SomeEvent extends Event
{
    private ?string $result = null;

    public function setResult(string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function setFailed(string $message): self
    {
        return $this;
    }
}
