<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

class SkipFormEvents implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'preSubmitData',
        ];
    }

    public function preSubmitData()
    {
    }
}
