<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PreSubmitEvent;

class SkipFormEventClass implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            PreSubmitEvent::class => 'preSubmitData',
        ];
    }

    public function preSubmitData()
    {
    }
}
