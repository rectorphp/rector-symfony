<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DifferentParameterTypeSameNameUsed extends AbstractController
{
    public function one(Foo $service)
    {
        dump($service);
    }

    public function two(Foo $service)
    {
        dump($service);
    }

    public function three(Bar $service)
    {
        dump($service);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DifferentParameterTypeSameNameUsed extends AbstractController
{
    public function __construct(private readonly \Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture\Foo $service)
    {
    }
    public function one()
    {
        dump($this->service);
    }

    public function two()
    {
        dump($this->service);
    }

    public function three(Bar $service)
    {
        dump($service);
    }
}

?>