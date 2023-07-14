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
