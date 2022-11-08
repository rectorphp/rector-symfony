<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function allAction()
    {
    }

    public function shortAction()
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
     * @\Symfony\Component\Routing\Annotation\Route(path="/all/{foo}/{page}", name="all", requirements={"page" = "\d+"}, options={"compiler_class" = "App\Routing\Utf8RouteCompiler", "expose" = true, "foo1" = 5, "foo2" = "bar"}, defaults={"foo" = "foo123", "page" = 1, "nullableDefault" = null, "booleanDefaultTrue" = true, "booleanDefaultFalse" = false}, host="m.example.com", methods={"GET", "POST"}, schemes={"http", "https"}, condition="context.getMethod() in ['GET', 'HEAD'] and request.headers.get('User-Agent') matches '/firefox/i'")
     */
    public function allAction()
    {
    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route(path="/short", name="short")
     */
    public function shortAction()
    {
    }
}

?>
