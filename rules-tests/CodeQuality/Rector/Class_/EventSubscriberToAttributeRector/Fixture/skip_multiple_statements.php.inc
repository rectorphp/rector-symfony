<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class SkipMultipleStatements implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function callMe()
    {
    }

    public static function getSubscribedEvents(): array
    {
        $events = ['some_event' => 'callMe'];

        return $events;
    }
}

?>
