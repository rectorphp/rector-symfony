<?php

namespace Rector\Symfony\Tests\Symfony64\Rector\Class_\ChangeRouteAttributeFromAnnotationSubnamespaceRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[\Symfony\Component\Routing\Annotation\Route('/blog', name: 'blog_list')]
class RectorController
{
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

#[\Symfony\Component\Routing\Attribute\Route('/blog', name: 'blog_list')]
class RectorController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}

?>
