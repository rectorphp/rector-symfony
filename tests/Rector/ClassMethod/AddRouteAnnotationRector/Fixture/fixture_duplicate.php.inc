<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function duplicateAction()
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
     * @\Symfony\Component\Routing\Annotation\Route(path="/duplicate/{foo}/{page}", name="duplicate_all")
     * @\Symfony\Component\Routing\Annotation\Route(path="/duplicate/{foo}", name="duplicate_all_short")
     */
    public function duplicateAction()
    {
    }
}

?>
