<?php

namespace Rector\Symfony\Tests\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

use Symfony\Component\HttpFoundation\Response;

final class SkipNoArgNewResponse
{
    public function index()
    {
        return new Response('some_content');
    }
}
