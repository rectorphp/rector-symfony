<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class RequestNew
{
    public function detail()
    {
        return Request::create('path', 'GET');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class RequestNew
{
    public function detail()
    {
        return Request::create('path', \Symfony\Component\HttpFoundation\Request::METHOD_GET);
    }
}

?>
