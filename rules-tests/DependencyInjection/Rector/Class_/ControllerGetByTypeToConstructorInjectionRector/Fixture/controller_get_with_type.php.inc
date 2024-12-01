<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class ControllerGetWithType extends Controller
{
    public function configure()
    {
        $someType = $this->get(SomeService::class);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class ControllerGetWithType extends Controller
{
    public function __construct(private \Rector\Symfony\Tests\DependencyInjection\Rector\Class_\ControllerGetByTypeToConstructorInjectionRector\Source\SomeService $someService)
    {
    }
    public function configure()
    {
        $someType = $this->someService;
    }
}

?>
