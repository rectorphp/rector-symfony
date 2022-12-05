<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class RedirectResponse extends AbstractController
{
    #[Route]
    public function redirectAction()
    {
        return $this->redirect('/');
    }

    #[Route]
    public function redirectToRouteAction()
    {
        return $this->redirectToRoute('some_template');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class RedirectResponse extends AbstractController
{
    #[Route]
    public function redirectAction(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return $this->redirect('/');
    }

    #[Route]
    public function redirectToRouteAction(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return $this->redirectToRoute('some_template');
    }
}

?>
