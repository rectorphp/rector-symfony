<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class MultipleEventSubscriptionsForSameMethod implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function callMeMultipleTimes()
    {
    }
    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return ['first_event' => 'callMeMultipleTimes', 'second_event' => 'callMeMultipleTimes'];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class MultipleEventSubscriptionsForSameMethod
{
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'first_event')]
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'second_event')]
    public function callMeMultipleTimes()
    {
    }
}

?>
