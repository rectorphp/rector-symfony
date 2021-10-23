<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassWithNamedService extends Controller
{
    public function someAction()
    {
        $this->getRequest()->getSomething();
    }
}

?>
-----
<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassWithNamedService extends Controller
{
    public function someAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $request->getSomething();
    }
}

?>
