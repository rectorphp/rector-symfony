<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\CommandGetByTypeToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

final class CommandGetWithType extends ContainerAwareCommand
{
    public function configure()
    {
        $someType = $this->get(SomeService::class);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\CommandGetByTypeToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

final class CommandGetWithType extends ContainerAwareCommand
{
    public function __construct(private \Rector\Symfony\Tests\DependencyInjection\Rector\Class_\CommandGetByTypeToConstructorInjectionRector\Fixture\SomeService $someService)
    {
        parent::__construct();
    }
    public function configure()
    {
        $someType = $this->someService;
    }
}

?>
