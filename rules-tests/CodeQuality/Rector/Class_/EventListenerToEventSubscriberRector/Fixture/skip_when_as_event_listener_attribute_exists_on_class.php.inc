<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

#[AsEventListener]
class SingleMethodListener
{
    public function __invoke()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

#[AsEventListener]
class SingleMethodListener
{
    public function __invoke()
    {
    }
}

?>
