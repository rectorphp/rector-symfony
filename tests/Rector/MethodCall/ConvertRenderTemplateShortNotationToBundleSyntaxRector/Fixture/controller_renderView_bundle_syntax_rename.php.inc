<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ConvertRenderTemplateShortNotationToBundleSyntaxRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    function indexAction()
    {
        $this->renderView('appBundle:Landing\Main:index.html.twig');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ConvertRenderTemplateShortNotationToBundleSyntaxRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    function indexAction()
    {
        $this->renderView('@app/Landing/Main/index.html.twig');
    }
}

?>
