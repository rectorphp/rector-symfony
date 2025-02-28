<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

class SomeListener
{
    public function methodToBeCalled()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventListenerToEventSubscriberRector\Fixture;

class SomeEventSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function methodToBeCalled()
    {
    }
    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return ['some_event' => 'methodToBeCalled', \Symfony\Component\HttpKernel\KernelEvents::EXCEPTION => 'onKernelException'];
    }
}

?>
