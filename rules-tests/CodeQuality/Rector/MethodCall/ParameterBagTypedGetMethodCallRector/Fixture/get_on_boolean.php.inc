<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\ParameterBagTypedGetMethodCallRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class GetOnBoolean
{
    public function run(Request $request)
    {
        $debug = (bool) $request->query->get('debug', false);
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
