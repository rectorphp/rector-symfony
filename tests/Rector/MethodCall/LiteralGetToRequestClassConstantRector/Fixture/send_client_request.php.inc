<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Component\HttpKernel\Client;

final class SendClientRequest
{
    public function detail(Client $client)
    {
        $client->request('GET');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Component\HttpKernel\Client;

final class SendClientRequest
{
    public function detail(Client $client)
    {
        $client->request(\Symfony\Component\HttpFoundation\Request::METHOD_GET);
    }
}

?>
