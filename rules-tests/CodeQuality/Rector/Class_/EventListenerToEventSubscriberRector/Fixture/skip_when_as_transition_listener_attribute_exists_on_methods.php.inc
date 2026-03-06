<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\Workflow\Attribute\AsTransitionListener;

class TransactionWorkflowListener
{
    #[AsTransitionListener(workflow: 'transaction', transition: 'pay')]
    public function onPay()
    {
    }

    #[AsTransitionListener(workflow: 'transaction', transition: 'complete')]
    public function onComplete()
    {
    }
}