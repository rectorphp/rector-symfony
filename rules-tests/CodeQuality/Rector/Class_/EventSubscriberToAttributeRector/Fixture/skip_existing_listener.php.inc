<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

class ExistingListenerAttribute implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    #[AsEventListener(event: 'first_event')]
    public function callMe()
    {
    }
    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return ['first_event' => 'callMe', 'second_event' => 'callMe'];
    }
}

?>
