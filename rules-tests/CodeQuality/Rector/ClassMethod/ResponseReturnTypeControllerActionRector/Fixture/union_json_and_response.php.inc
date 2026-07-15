<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UnionJsonAndResponse extends AbstractController
{
    /**
     * @Route()
     */
    public function sendAction()
    {
        if (mt_rand(0, 1)) {
            return new JsonResponse('yes');
        }

        return new Response('no');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UnionJsonAndResponse extends AbstractController
{
    /**
     * @Route()
     */
    public function sendAction(): \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if (mt_rand(0, 1)) {
            return new JsonResponse('yes');
        }

        return new Response('no');
    }
}

?>
