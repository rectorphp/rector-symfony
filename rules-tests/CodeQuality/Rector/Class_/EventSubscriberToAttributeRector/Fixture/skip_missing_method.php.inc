<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class SkipMissingMethod implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function callMe()
    {
    }

    public static function getSubscribedEvents(): array
    {
        return ['first_event' => 'callMe', 'second_event' => 'doesNotExist'];
    }
}

?>
