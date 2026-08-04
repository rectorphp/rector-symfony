<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class SkipEventSubscriberMethod extends AbstractController implements EventSubscriberInterface
{
    public function onRequest(RequestEvent $requestEvent): void
    {
        $controller = $requestEvent->getRequest()->attributes->get('_controller');
    }

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onRequest',
        ];
    }
}
