<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\ConvertRenderTemplateShortNotationToBundleSyntaxRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    function indexAction()
    {
        $this->render('@app/Landing/Main/index.html.twig');
    }
}

?>
