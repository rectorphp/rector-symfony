<?php

namespace Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function nullAction()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route(path="/null/as/default/{nullableDefault}", name="null_as_default", options={"nullableOption"=null}, defaults={"nullableDefault"=null})
     */
    public function nullAction()
    {
    }
}

?>
