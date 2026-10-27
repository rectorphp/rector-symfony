<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class MultipleEventSubscriptions implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function callMe()
    {
    }

    public function singles()
    {
    }

    public function meToo()
    {
    }
    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return ['single_event' => 'singles', 'multi_event' => [['callMe'], ['meToo']]];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

class MultipleEventSubscriptions
{
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'multi_event')]
    public function callMe()
    {
    }
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'single_event')]
    public function singles()
    {
    }
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'multi_event')]
    public function meToo()
    {
    }
}

?>
