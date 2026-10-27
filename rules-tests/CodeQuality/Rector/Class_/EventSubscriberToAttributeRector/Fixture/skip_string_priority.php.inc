<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class SkipStringPriority implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function callMe()
    {
    }

    public static function getSubscribedEvents(): array
    {
        return ['some_event' => ['callMe', 'high']];
    }
}

?>
