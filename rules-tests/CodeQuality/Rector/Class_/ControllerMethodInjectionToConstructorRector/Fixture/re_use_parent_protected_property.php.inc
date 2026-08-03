<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\ParentControllerWithProtectedProperty;
use Symfony\Component\Routing\Annotation\Route;

final class ReUseParentProtectedProperty extends ParentControllerWithProtectedProperty
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
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\ParentControllerWithProtectedProperty;
use Symfony\Component\Routing\Annotation\Route;

final class ReUseParentProtectedProperty extends ParentControllerWithProtectedProperty
{
    #[Route('/example', name: 'example')]
    public function example()
    {
        $this->logger->log('level', 'value');
    }
}

?>
