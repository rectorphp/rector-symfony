<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class SkipNestedAndExistingParamController extends AbstractController
{
    public function run(Request $request, int $page = 1): void
    {
        $page = $request->query->getInt('page');

        if ($request->isMethod('GET')) {
            $limit = $request->query->getInt('limit');
        }
    }

    private function helper(Request $request): void
    {
        $page = $request->query->getInt('page');
    }
}

?>
