<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class HandleViewTraitOnly extends AbstractController
{
    use ControllerTrait;

    /**
     * @Route()
     */
    public function listAction()
    {
        $view = $this->view(['ok' => true]);

        return $this->handleView($view);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class HandleViewTraitOnly extends AbstractController
{
    use ControllerTrait;

    /**
     * @Route()
     */
    public function listAction(): \Symfony\Component\HttpFoundation\Response
    {
        $view = $this->view(['ok' => true]);

        return $this->handleView($view);
    }
}

?>
