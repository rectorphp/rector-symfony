<?php

namespace Rector\Symfony\Tests\Symfony64\Rector\Class_\ChangeRouteAttributeFromAnnotationSubnamespaceRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class MultipleCasesAboveMethod
{
    #[\Symfony\Component\Routing\Annotation\Route('/blog', name: 'blog_list')]
    #[\Symfony\Component\Routing\Annotation\Route('/fallback', name: 'old')]
    public function first(Request $request): JsonResponse
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

final class MultipleCasesAboveMethod
{
    #[\Symfony\Component\Routing\Attribute\Route('/blog', name: 'blog_list')]
    #[\Symfony\Component\Routing\Attribute\Route('/fallback', name: 'old')]
    public function first(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}

?>
