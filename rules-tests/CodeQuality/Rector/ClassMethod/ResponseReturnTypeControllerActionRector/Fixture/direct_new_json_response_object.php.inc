<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class DirectNewJsonResponseObject extends AbstractController
{
    /**
     * @Route()
     */
    public function jsonAction()
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse('...');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class DirectNewJsonResponseObject extends AbstractController
{
    /**
     * @Route()
     */
    public function jsonAction(): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse('...');
    }
}

?>
