<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\Workflow\Attribute\AsEnteredListener;

class WorkflowEnteredListener
{
    #[AsEnteredListener(workflow: 'order')]
    public function onEntered()
    {
    }
}