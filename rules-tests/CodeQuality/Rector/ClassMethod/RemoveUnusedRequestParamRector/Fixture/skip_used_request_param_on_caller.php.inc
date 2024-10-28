<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RemoveUnusedRequestParamRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class SkipUsedRequestParamOnCaller extends Controller
{
    public function run(Request $request)
    {
        $this->verify($request);
    }

    public function verify(Request $request)
    {
    }
}
