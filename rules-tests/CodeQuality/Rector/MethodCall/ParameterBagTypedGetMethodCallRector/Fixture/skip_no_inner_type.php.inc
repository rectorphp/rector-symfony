<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class SkipNoInnerType
{
    public function run(Request $request)
    {
        $debug = filter_var(
            $request->query->get('debug', true),
            FILTER_VALIDATE_BOOLEAN
        );
    }
}
