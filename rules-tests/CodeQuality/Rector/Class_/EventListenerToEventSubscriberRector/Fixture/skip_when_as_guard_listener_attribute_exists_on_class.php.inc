<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\Workflow\Attribute\AsGuardListener;

#[AsGuardListener(workflow: 'order')]
class OrderGuardListener
{
    public function __invoke()
    {
    }
}