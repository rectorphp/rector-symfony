<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RemoveUnusedRequestParamRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SkipUsedRequestParam extends Controller
{
    public function run(Request $request)
    {
        echo $request->get('id');
    }
}
