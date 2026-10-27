<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class SkipNonController
{
    public function run(Request $request): void
    {
        $page = $request->query->getInt('page');
    }
}

?>
