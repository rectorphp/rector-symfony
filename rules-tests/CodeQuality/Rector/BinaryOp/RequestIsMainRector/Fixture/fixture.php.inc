<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\BinaryOp\RequestIsMainRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;

final class SomeController
{
    public function index(Request $request)
    {
        return $request->getRequestType() === HttpKernel::MASTER_REQUEST;
    }

    public function second(Request $request)
    {
        return $request->getRequestType() === HttpKernel::MAIN_REQUEST;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\BinaryOp\RequestIsMainRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;

final class SomeController
{
    public function index(Request $request)
    {
        return $request->isMainRequest();
    }

    public function second(Request $request)
    {
        return $request->isMainRequest();
    }
}

?>
