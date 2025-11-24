<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DoNotReplaceVariableAssign extends AbstractController
{
    public function someAction(\Psr\Log\LoggerInterface $logger)
    {
        $logger = $this->modify($logger);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DoNotReplaceVariableAssign extends AbstractController
{
    public function __construct(private readonly \Psr\Log\LoggerInterface $logger)
    {
    }
    public function someAction()
    {
        $logger = $this->modify($this->logger);
    }
}

?>