<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\ConvertRenderTemplateShortNotationToBundleSyntaxRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    function indexAction()
    {
        $this->render('appBundle:Landing\Main:index.html.twig');
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
        $this->render('@app/Landing/Main/index.html.twig');
    }
}

?>
