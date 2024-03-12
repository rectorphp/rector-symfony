<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

class MultiMethodListener
{
    #[AsEventListener]
    public function onMethodA()
    {
    }

    #[AsEventListener]
    public function onMethodB()
    {
    }
}

?>
