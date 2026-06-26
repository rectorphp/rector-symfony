<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source\SomeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class EarlyReturnInCondition implements EventSubscriberInterface
{
    public function onEvent(SomeEvent $event): SomeEvent
    {
        if (mt_rand(0, 1)) {
            return $event->setResult('yes');
        }

        return $event->setFailed('no');
    }

    public static function getSubscribedEvents(): array
    {
        return ['some_event' => 'onEvent'];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberMethodReturnVoidRector\Source\SomeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class EarlyReturnInCondition implements EventSubscriberInterface
{
    public function onEvent(SomeEvent $event): void
    {
        if (mt_rand(0, 1)) {
            $event->setResult('yes');
            return;
        }

        $event->setFailed('no');
    }

    public static function getSubscribedEvents(): array
    {
        return ['some_event' => 'onEvent'];
    }
}

?>
