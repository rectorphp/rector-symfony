<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassWithNamedService3 extends Controller
{
    public function render()
    {
        $this->renderTwig([
            'posts' => $this->get(\Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Foo\Bar::class)->callMe(),
            'comments' => $this->get(\Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Bar\Bar::class)->callMe(),
        ]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassWithNamedService3 extends Controller
{
    public function __construct(private \Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Foo\Bar $bar, private \Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\Bar\Bar $bar2)
    {
    }
    public function render()
    {
        $this->renderTwig([
            'posts' => $this->bar->callMe(),
            'comments' => $this->bar2->callMe(),
        ]);
    }
}

?>
