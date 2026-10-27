<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class SkipVariableUsedBeforeController extends AbstractController
{
    public function run(Request $request): void
    {
        $page = 5;
        echo $page;
        $page = $request->query->getInt('page');
    }
}

?>
