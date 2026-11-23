<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\FixtureWithoutFrameworkBundle;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class SkipWithoutFrameworkBundle implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return ['some_event' => 'onSomeEvent'];
    }

    public function onSomeEvent()
    {
    }
}
