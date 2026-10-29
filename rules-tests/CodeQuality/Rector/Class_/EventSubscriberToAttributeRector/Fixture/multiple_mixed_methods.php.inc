<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class MultipleMixedMethods implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {
    }

    public function singles()
    {
    }

    public function unknownMethod()
    {
    }
    /**
     * @return array<string, mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return ['single_event' => 'singles', \Symfony\Component\HttpKernel\KernelEvents::EXCEPTION => 'onKernelException'];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\EventSubscriberToAttributeRector\Fixture;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class MultipleMixedMethods
{
    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: \Symfony\Component\HttpKernel\KernelEvents::EXCEPTION)]
    public function onKernelException(ExceptionEvent $event)
    {
    }

    #[\Symfony\Component\EventDispatcher\Attribute\AsEventListener(event: 'single_event')]
    public function singles()
    {
    }

    public function unknownMethod()
    {
    }
}

?>
