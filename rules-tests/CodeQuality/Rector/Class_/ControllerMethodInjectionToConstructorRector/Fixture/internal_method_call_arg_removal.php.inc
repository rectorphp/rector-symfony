<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class InternalMethodCallArgRemoval extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(LoggerInterface $logger)
    {
        $this->problematic($logger);
    }

    public function problematic(LoggerInterface $logger, ?string $optional = 'test')
    {
        $logger->log('level', 'value');
        dump($optional);
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

final class InternalMethodCallArgRemoval extends AbstractController
{
    public function __construct(private readonly \Psr\Log\LoggerInterface $logger)
    {
    }
    #[Route('/some-action', name: 'some_action')]
    public function someAction()
    {
        $this->problematic();
    }

    public function problematic(?string $optional = 'test')
    {
        $this->logger->log('level', 'value');
        dump($optional);
    }
}

?>
