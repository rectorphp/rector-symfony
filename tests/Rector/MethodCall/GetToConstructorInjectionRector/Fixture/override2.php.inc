<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function foo()
    {
        $this->renderTwig([
            'posts' => $this->get(\Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Something::class)->callMe(),
        ]);
    }
}

class MyController extends BaseController
{
    public function bar()
    {
        $this->renderTwig([
            'posts' => $this->get(\Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Something::class)->callMe(),
            'comments' => $this->get(\Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Anything::class)->callMe(),
        ]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function __construct(private \Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Something $something)
    {
    }
    public function foo()
    {
        $this->renderTwig([
            'posts' => $this->something->callMe(),
        ]);
    }
}

class MyController extends BaseController
{
    public function __construct(private \Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Something $something, private \Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Anything $anything)
    {
        parent::__construct($something);
    }
    public function bar()
    {
        $this->renderTwig([
            'posts' => $this->something->callMe(),
            'comments' => $this->anything->callMe(),
        ]);
    }
}

?>
