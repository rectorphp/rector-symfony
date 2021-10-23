<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\TestCase\Request;

class ClassWithParameterPresent extends Controller
{
    public function someAction(Request $request)
    {
        $this->getRequest()->getSomething();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\TestCase\Request;

class ClassWithParameterPresent extends Controller
{
    public function someAction(Request $request, \Symfony\Component\HttpFoundation\Request $mainRequest)
    {
        $mainRequest->getSomething();
    }
}

?>
