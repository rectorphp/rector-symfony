<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CoverContainerProperty extends Controller
{
    public function configure()
    {
        $someType = $this->container->get(SomeService::class);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CoverContainerProperty extends Controller
{
    public function __construct(private readonly \Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService $someService)
    {
    }
    public function configure()
    {
        $someType = $this->someService;
    }
}

?>
