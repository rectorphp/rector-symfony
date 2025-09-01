<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class GetOnBoolean
{
    public function run(Request $request)
    {
        $debug = filter_var(
            $request->query->get('debug', false),
            FILTER_VALIDATE_BOOLEAN
        );
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class GetOnBoolean
{
    public function run(Request $request)
    {
        $debug = $request->query->getBoolean('debug');
    }
}

?>
