<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipVoidJsonResponseObject extends AbstractController
{
    /**
     * @Route()
     */
    public function jsonAction()
    {
        if (mt_rand(0, 1)) {
            $jsonResponse = new \Symfony\Component\HttpFoundation\JsonResponse('');
            return $jsonResponse;
        }
    }
}
