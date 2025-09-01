<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class SkipSoleExprFilterVar
{
    public function run(Request $request)
    {
        $debug = filter_var(
            $request->query->get('debug', false),
        );
    }
}
