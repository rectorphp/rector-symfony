<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class WithFqnRoute extends Controller
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route("/some-action", name="some_action")
     */
    public function someAction()
    {
        $this->getRequest()->getSomething();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class WithFqnRoute extends Controller
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route("/some-action", name="some_action")
     */
    public function someAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $request->getSomething();
    }
}

?>
