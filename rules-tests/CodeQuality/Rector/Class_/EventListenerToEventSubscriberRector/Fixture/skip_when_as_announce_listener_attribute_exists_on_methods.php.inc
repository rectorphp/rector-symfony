<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\Workflow\Attribute\AsAnnounceListener;

class WorkflowAnnounceListener
{
    #[AsAnnounceListener(workflow: 'order')]
    public function onAnnounce()
    {
    }
}