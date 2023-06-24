<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RemoveUnusedRequestParamRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends Controller
{
    abstract public function fooAction(Request $request): Response;
}

class DontOverrideParentAbstractClassMethodController extends AbstractController
{
    public function fooAction(Request $request): Response
    {
        return new Response();
    }

    public function barAction(Request $request): Response
    {
        return new Response();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RemoveUnusedRequestParamRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends Controller
{
    abstract public function fooAction(Request $request): Response;
}

class DontOverrideParentAbstractClassMethodController extends AbstractController
{
    public function fooAction(Request $request): Response
    {
        return new Response();
    }

    public function barAction(): Response
    {
        return new Response();
    }
}

?>
