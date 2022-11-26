<?php

namespace Rector\Tests\Symfony\Rector\MethodCall\GetParameterToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;

class Service {
}

abstract class Controller extends SymfonyController {
    public function __construct(protected Service $service)
    {
        // do something else
    }
}

class TestController extends Controller
{
    public function test()
    {
        $foo = $this->getParameter('foo') . $this->getParameter('bar');
    }
}

?>
-----
<?php

namespace Rector\Tests\Symfony\Rector\MethodCall\GetParameterToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;

class Service {
}

abstract class Controller extends SymfonyController {
    public function __construct(protected Service $service)
    {
        // do something else
    }
}

class TestController extends Controller
{
    public function __construct(\Rector\Tests\Symfony\Rector\MethodCall\GetParameterToConstructorInjectionRector\Fixture\Service $service, private string $foo, private string $bar)
    {
        parent::__construct($service);
    }
    public function test()
    {
        $foo = $this->foo . $this->bar;
    }
}

?>
