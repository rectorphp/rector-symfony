<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\Workflow\Attribute\AsCompletedListener;

class WorkflowCompletedListener
{
    #[AsCompletedListener(workflow: 'order')]
    public function onCompleted()
    {
    }
}