<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\FixtureTypeGuarded;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NonGuardedController extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(LoggerInterface $logger)
    {
        $logger->log('level', 'value');
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\FixtureTypeGuarded;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NonGuardedController extends AbstractController
{
    public function __construct(private readonly \Psr\Log\LoggerInterface $logger)
    {
    }
    #[Route('/some-action', name: 'some_action')]
    public function someAction()
    {
        $this->logger->log('level', 'value');
    }
}

?>
