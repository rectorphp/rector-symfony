<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source\SomeEvent;

final class SkipNotSubscriber
{
    public function onEvent(SomeEvent $event): SomeEvent
    {
        return $event->setResult('value');
    }
}
