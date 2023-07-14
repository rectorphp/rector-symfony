<?php

namespace Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InvokeController extends Controller
{
    public function __invoke()
    {
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InvokeController extends Controller
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route(path="/invoke", name="invokable")
     */
    public function __invoke()
    {
    }
}
?>
