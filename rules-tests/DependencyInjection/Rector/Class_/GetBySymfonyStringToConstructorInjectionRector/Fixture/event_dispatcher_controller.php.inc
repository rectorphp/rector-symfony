<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class EventDispatcherController extends Controller
{
    public function configure()
    {
        $someType = $this->get('event_dispatcher');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class EventDispatcherController extends Controller
{
    public function __construct(private readonly \Symfony\Contracts\EventDispatcher\EventDispatcherInterface $eventDispatcher)
    {
    }
    public function configure()
    {
        $someType = $this->eventDispatcher;
    }
}

?>
