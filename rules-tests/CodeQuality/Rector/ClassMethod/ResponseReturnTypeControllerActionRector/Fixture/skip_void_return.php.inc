<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class SkipVoidReturn extends AbstractController
{
    /**
     * @Route()
     */
    public function jsonAction()
    {
        $jsonResponse = new JsonResponse('yes');
        if (mt_rand(0, 1)) {
            return;
        }
    }
}
