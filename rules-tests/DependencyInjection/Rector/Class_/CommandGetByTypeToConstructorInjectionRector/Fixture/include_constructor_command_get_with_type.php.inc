<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\CommandGetByTypeToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

final class IncludeConstructorCommandGetWithType extends ContainerAwareCommand
{
    private string $value;

    public function __construct()
    {
        $this->value = 'some';
        parent::__construct();
    }

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

final class IncludeConstructorCommandGetWithType extends ContainerAwareCommand
{
    private string $value;

    public function __construct(private readonly \Rector\Symfony\Tests\DependencyInjection\Rector\Class_\CommandGetByTypeToConstructorInjectionRector\Fixture\SomeService $someService)
    {
        $this->value = 'some';
        parent::__construct();
    }

    public function configure()
    {
        $someType = $this->someService;
    }
}

?>
