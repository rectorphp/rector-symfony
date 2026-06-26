<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source\SomeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class SkipMethodNotRegistered implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return ['some_event' => 'onEvent'];
    }

    public function onEvent(SomeEvent $event): void
    {
        $event->setResult('value');
    }

    public function notAHook(SomeEvent $event): SomeEvent
    {
        return $event->setResult('value');
    }
}
