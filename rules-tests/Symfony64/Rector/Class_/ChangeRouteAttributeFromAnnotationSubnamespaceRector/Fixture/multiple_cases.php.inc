<?php

namespace Rector\Symfony\Tests\Symfony64\Rector\Class_\ChangeRouteAttributeFromAnnotationSubnamespaceRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MultipleCases
{
    #[\Symfony\Component\Routing\Annotation\Route('/blog', name: 'blog_list')]
    public function first(Request $request): JsonResponse
    {
        return new JsonResponse();
    }

    #[\Symfony\Component\Routing\Annotation\Route('/blog', name: 'blog_item')]
    public function second(Request $request): JsonResponse
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

class MultipleCases
{
    #[\Symfony\Component\Routing\Attribute\Route('/blog', name: 'blog_list')]
    public function first(Request $request): JsonResponse
    {
        return new JsonResponse();
    }

    #[\Symfony\Component\Routing\Attribute\Route('/blog', name: 'blog_item')]
    public function second(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}

?>
