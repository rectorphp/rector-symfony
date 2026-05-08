<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ClassWithNamedService extends Controller
{
    /**
     * @Route("/some-action", name="some_action")
     */
    public function someAction()
    {
        $this->getRequest()->getSomething();
    }
}

?>
-----
<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ClassWithNamedService extends Controller
{
    /**
     * @Route("/some-action", name="some_action")
     */
    public function someAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $request->getSomething();
    }
}

?>
