<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class NewJsonResponseObject extends AbstractController
{
    /**
     * @Route()
     */
    public function jsonAction()
    {
        $jsonResponse = new \Symfony\Component\HttpFoundation\JsonResponse('');

        return $jsonResponse;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class NewJsonResponseObject extends AbstractController
{
    /**
     * @Route()
     */
    public function jsonAction(): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $jsonResponse = new \Symfony\Component\HttpFoundation\JsonResponse('');

        return $jsonResponse;
    }
}

?>
