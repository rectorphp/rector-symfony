<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function __invoke()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route(path="/", name="invokable")
     */
    public function __invoke()
    {
    }
}

?>
