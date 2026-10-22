<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class WithPriorityEventSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function callMe()
    {
    }
    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return ['some_event' => ['callMe', 1540]];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class WithPriorityEventSubscriber
{
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'some_event', priority: 1540)]
    public function callMe()
    {
    }
}

?>
