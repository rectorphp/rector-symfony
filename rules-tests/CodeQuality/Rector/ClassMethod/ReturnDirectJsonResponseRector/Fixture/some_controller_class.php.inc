<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ReturnDirectJsonResponseRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class SomeControllerClass extends AbstractController
{
    public function index()
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setData([
            'status' => 'ok',
        ]);

        return $jsonResponse;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ReturnDirectJsonResponseRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class SomeControllerClass extends AbstractController
{
    public function index()
    {
        return new \Symfony\Component\HttpFoundation\JsonResponse([
            'status' => 'ok',
        ]);
    }
}

?>
