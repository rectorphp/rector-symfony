<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class SameNameController extends AbstractController
{
    public function myAction(Request $request): void
    {
        $platformId = $request->query->getInt('platformId');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class SameNameController extends AbstractController
{
    public function myAction(
        Request $request,
        #[\Symfony\Component\HttpKernel\Attribute\MapQueryParameter]
        int $platformId = 0
    ): void
    {
    }
}

?>
