<?php

namespace Rector\Symfony\Tests\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

use Symfony\Component\HttpFoundation\Response;

final class NewResponse
{
    public function index()
    {
        return new Response('some_content', 200);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

use Symfony\Component\HttpFoundation\Response;

final class NewResponse
{
    public function index()
    {
        return new Response('some_content', \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }
}

?>
