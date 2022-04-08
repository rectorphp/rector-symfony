<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\BaseController;

class ClassWithNamedService extends BaseController
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

namespace Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\BaseController;

class ClassWithNamedService extends BaseController
{
    public function __construct(private \stdClass $stdClass, private \stdClass $formFactory)
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
