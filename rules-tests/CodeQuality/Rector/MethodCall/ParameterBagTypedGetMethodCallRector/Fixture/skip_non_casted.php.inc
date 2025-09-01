<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class SkipNonCasted
{
    public function run(Request $request)
    {
        $debug = $request->query->get('debug', false);
    }
}
