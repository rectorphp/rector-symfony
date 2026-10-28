<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SkipFormEventsString implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'form.pre_submit' => 'preSubmitData',
        ];
    }

    public function preSubmitData()
    {
    }
}
