<?php

namespace Rector\Symfony\Tests\Symfony28\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassWithNamedService extends Controller
{
    public function render()
    {
        $someService = $this->get('some_service');

        $this->renderTwig([
            'posts' => $this->get('some_service')->callMe()
        ]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony28\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassWithNamedService extends Controller
{
    public function __construct(private readonly \stdClass $stdClass)
    {
    }
    public function render()
    {
        $someService = $this->stdClass;

        $this->renderTwig([
            'posts' => $this->stdClass->callMe()
        ]);
    }
}

?>
