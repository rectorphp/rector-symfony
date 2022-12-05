<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class ResponseController extends AbstractController
{
    #[Route]
    public function renderAction()
    {
        return $this->render('some_template');
    }

    #[Route]
    public function forwardAction()
    {
        return $this->forward('some_controller');
    }

    #[Route]
    public function renderFormAction()
    {
        return $this->renderForm('some_view');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class ResponseController extends AbstractController
{
    #[Route]
    public function renderAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('some_template');
    }

    #[Route]
    public function forwardAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->forward('some_controller');
    }

    #[Route]
    public function renderFormAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->renderForm('some_view');
    }
}

?>
