<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\TestCase\Request;

final class ClassWithParameterPresent extends Controller
{
    /**
     * @Route("/some-action", name="some_action")
     */
    public function someAction(Request $request)
    {
        $this->getRequest()->getSomething();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\TestCase\Request;

final class ClassWithParameterPresent extends Controller
{
    /**
     * @Route("/some-action", name="some_action")
     */
    public function someAction(Request $request, \Symfony\Component\HttpFoundation\Request $mainRequest)
    {
        $mainRequest->getSomething();
    }
}

?>
