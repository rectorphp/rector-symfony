<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\FixturePrePromoted;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SomeControllerWithMethodInjection extends AbstractController
{
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

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\FixturePrePromoted;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SomeControllerWithMethodInjection extends AbstractController
{
    private \Psr\Log\LoggerInterface $logger;
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    #[Route('/some-action', name: 'some_action')]
    public function someAction(
        \Symfony\Component\HttpFoundation\Request $request
    ) {
        $this->logger->log('level', 'value');
    }
}

?>
