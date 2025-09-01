<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class SkipFirstClassCallable
{
    public function run(Request $request)
    {
        $debug = (bool) $request->query->get(...);
    }
}
