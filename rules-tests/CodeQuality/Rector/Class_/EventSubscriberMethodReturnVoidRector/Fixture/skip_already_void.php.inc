<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source\SomeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class SkipAlreadyVoid implements EventSubscriberInterface
{
    public function onEvent(SomeEvent $event): void
    {
        $event->setResult('value');
    }

    public static function getSubscribedEvents(): array
    {
        return ['some_event' => 'onEvent'];
    }
}
