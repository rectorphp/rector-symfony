<?php

namespace Rector\Symfony\Tests\Symfony64\Rector\Class_\ChangeRouteAttributeFromAnnotationSubnamespaceRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RectorController
{
    #[\Symfony\Component\Routing\Annotation\Route('/blog', name: 'blog_list')]
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

class RectorController
{
    #[\Symfony\Component\Routing\Attribute\Route('/blog', name: 'blog_list')]
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}

?>
