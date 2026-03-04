<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\Workflow\Attribute\AsEnterListener;

class WorkflowEnterListener
{
    #[AsEnterListener(workflow: 'order')]
    public function onEnter()
    {
    }
}