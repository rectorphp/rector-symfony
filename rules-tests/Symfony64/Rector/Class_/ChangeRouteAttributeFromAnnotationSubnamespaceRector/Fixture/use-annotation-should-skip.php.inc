<?php

namespace Rector\Symfony\Tests\Symfony64\Rector\Class_\ChangeRouteAttributeFromAnnotationSubnamespaceRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
USE Symfony\Component\Routing\Annotation\Route;

class RectorController
{
    /**
     * @Route("/")
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony64\Rector\Class_\ChangeRouteAttributeFromAnnotationSubnamespaceRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
USE Symfony\Component\Routing\Annotation\Route;

class RectorController
{
    /**
     * @Route("/")
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}

?>
