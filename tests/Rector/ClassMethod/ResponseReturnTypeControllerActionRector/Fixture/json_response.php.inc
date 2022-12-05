<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class JsonResponse extends AbstractController
{
    #[Route]
    public function jsonAction()
    {
        return $this->json('');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class JsonResponse extends AbstractController
{
    #[Route]
    public function jsonAction(): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json('');
    }
}

?>
