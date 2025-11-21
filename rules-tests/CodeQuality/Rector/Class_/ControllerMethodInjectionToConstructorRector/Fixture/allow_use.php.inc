<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class AllwoUse extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/some-action', name: 'some_action')]
    public function someAction(LoggerInterface $logger)
    {
        $someClosure = function () use ($logger) {
            $logger->log('level', 'value');
        };
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class AllwoUse extends AbstractController
{
    public function __construct(private readonly \Psr\Log\LoggerInterface $logger)
    {
    }

    #[Route('/some-action', name: 'some_action')]
    public function someAction()
    {
        $someClosure = function () {
            $this->logger->log('level', 'value');
        };
    }
}

?>
