<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class GetStringController extends AbstractController
{
    public function search(Request $request): void
    {
        $term = $request->query->getString('q');
        $sort = $request->query->getString('sort', 'date');

        echo $term . $sort;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class GetStringController extends AbstractController
{
    public function search(
        Request $request,
        #[\Symfony\Component\HttpKernel\Attribute\MapQueryParameter(name: 'q')]
        string $term = '',
        #[\Symfony\Component\HttpKernel\Attribute\MapQueryParameter]
        string $sort = 'date'
    ): void
    {
        echo $term . $sort;
    }
}

?>
