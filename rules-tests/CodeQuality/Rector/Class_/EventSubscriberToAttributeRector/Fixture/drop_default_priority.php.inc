<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class DropDefaultPriorityEventSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function callMe()
    {
    }
    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return ['some_event' => ['callMe', 0]];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class DropDefaultPriorityEventSubscriber
{
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'some_event')]
    public function callMe()
    {
    }
}

?>
