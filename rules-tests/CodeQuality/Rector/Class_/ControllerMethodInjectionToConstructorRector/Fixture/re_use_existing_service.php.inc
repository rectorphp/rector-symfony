<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class ReUseExistingService extends AbstractController
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    #[Route('/some-action', name: 'some_action')]
    public function someAction(
        \Symfony\Component\HttpFoundation\Request $request,
        \Psr\Log\LoggerInterface $logger
    ) {
        $logger->log('level', 'value');
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

final class ReUseExistingService extends AbstractController
{
    public function __construct(private readonly \Psr\Log\LoggerInterface $logger)
    {
    }

    #[Route('/some-action', name: 'some_action')]
    public function someAction(
        \Symfony\Component\HttpFoundation\Request $request
    ) {
        $this->logger->log('level', 'value');
    }
}

?>
