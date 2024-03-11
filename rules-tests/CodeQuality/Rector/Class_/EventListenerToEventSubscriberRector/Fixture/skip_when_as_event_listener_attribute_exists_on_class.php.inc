<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class SingleMethodListener
{
    public function __invoke()
    {
    }
}

?>
