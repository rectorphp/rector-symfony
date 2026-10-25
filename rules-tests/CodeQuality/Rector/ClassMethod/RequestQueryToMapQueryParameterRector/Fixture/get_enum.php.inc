<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Source\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class GetEnumController extends AbstractController
{
    public function list(Request $request): void
    {
        $status = $request->query->getEnum('status', Status::class);
        $fallbackStatus = $request->query->getEnum('fallback', Status::class, Status::Draft);

        var_dump($status, $fallbackStatus);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Source\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class GetEnumController extends AbstractController
{
    public function list(
        Request $request,
        #[\Symfony\Component\HttpKernel\Attribute\MapQueryParameter]
        ?\Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Source\Status $status = null,
        #[\Symfony\Component\HttpKernel\Attribute\MapQueryParameter(name: 'fallback')]
        \Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Source\Status $fallbackStatus = Status::Draft
    ): void
    {
        var_dump($status, $fallbackStatus);
    }
}

?>
