<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\RedirectToRouteRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    public function someAction()
    {
        return $this->redirect($this->generateUrl('something'));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\RedirectToRouteRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    public function someAction()
    {
        return $this->redirectToRoute('something');
    }
}

?>
