<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\ConvertRenderTemplateShortNotationToBundleSyntaxRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkipDynamicVariable extends Controller
{
    function indexAction()
    {
        $this->deferRender('appBundle:Landing\Main:index.html.twig');
    }

    function deferRender($template)
    {
        $this->render($template);
    }
}
