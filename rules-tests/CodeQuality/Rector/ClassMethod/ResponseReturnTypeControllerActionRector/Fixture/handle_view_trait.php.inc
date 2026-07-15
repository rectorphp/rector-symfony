<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HandleViewTrait extends AbstractController
{
    use ControllerTrait;

    /**
     * @Route()
     */
    public function sendAction()
    {
        if (mt_rand(0, 1)) {
            return new JsonResponse('disabled');
        }

        if (mt_rand(0, 1)) {
            return new Response('error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $view = $this->view(['success' => true], Response::HTTP_OK);

        return $this->handleView($view);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Source\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HandleViewTrait extends AbstractController
{
    use ControllerTrait;

    /**
     * @Route()
     */
    public function sendAction(): \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if (mt_rand(0, 1)) {
            return new JsonResponse('disabled');
        }

        if (mt_rand(0, 1)) {
            return new Response('error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $view = $this->view(['success' => true], Response::HTTP_OK);

        return $this->handleView($view);
    }
}

?>
