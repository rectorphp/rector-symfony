<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\ParentControllerWithAutowireMethod;
use Symfony\Component\Routing\Annotation\Route;

final class ParentWithAutowireMethod extends ParentControllerWithAutowireMethod
{
    #[Route('/example', name: 'example')]
    public function example(LoggerInterface $logger)
    {
        $logger->log('level', 'value');
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\ParentControllerWithAutowireMethod;
use Symfony\Component\Routing\Annotation\Route;

final class ParentWithAutowireMethod extends ParentControllerWithAutowireMethod
{
    private \Psr\Log\LoggerInterface $logger;
    #[Route('/example', name: 'example')]
    public function example()
    {
        $this->logger->log('level', 'value');
    }
    #[\Symfony\Contracts\Service\Attribute\Required]
    public function autowireServices(\Psr\Log\LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}

?>
