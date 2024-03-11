<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

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
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

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
