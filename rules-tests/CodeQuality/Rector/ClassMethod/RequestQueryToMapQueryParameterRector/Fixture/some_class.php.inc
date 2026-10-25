<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SomeClassController extends AbstractController
{
    public function list(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $isPublished = $request->query->getBoolean('published');

        return new Response($page . ($isPublished ? 'yes' : 'no'));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SomeClassController extends AbstractController
{
    public function list(
        Request $request,
        #[\Symfony\Component\HttpKernel\Attribute\MapQueryParameter]
        int $page = 1,
        #[\Symfony\Component\HttpKernel\Attribute\MapQueryParameter(name: 'published')]
        bool $isPublished = false
    ): Response
    {
        return new Response($page . ($isPublished ? 'yes' : 'no'));
    }
}

?>
