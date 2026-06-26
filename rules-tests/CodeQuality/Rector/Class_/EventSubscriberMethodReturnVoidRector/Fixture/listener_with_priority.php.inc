<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source\SomeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class ListenerWithPriority implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'first_event' => ['onFirst', 10],
            'second_event' => [['onSecond', 5], ['onSecondToo']],
        ];
    }

    public function onFirst(SomeEvent $event): SomeEvent
    {
        return $event->setResult('first');
    }

    public function onSecond(SomeEvent $event): SomeEvent
    {
        return $event->setResult('second');
    }

    public function onSecondToo(SomeEvent $event): SomeEvent
    {
        return $event->setResult('second too');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source\SomeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class ListenerWithPriority implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'first_event' => ['onFirst', 10],
            'second_event' => [['onSecond', 5], ['onSecondToo']],
        ];
    }

    public function onFirst(SomeEvent $event): void
    {
        $event->setResult('first');
    }

    public function onSecond(SomeEvent $event): void
    {
        $event->setResult('second');
    }

    public function onSecondToo(SomeEvent $event): void
    {
        $event->setResult('second too');
    }
}

?>
