<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\Workflow\Attribute\AsLeaveListener;

class WorkflowLeaveListener
{
    #[AsLeaveListener(workflow: 'order')]
    public function onLeave()
    {
    }
}