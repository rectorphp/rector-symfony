<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\BinaryOp\RequestIsMainRector\Fixture;

use Symfony\Component\HttpKernel\HttpKernel;

final class SkipDifferentType
{
    public function index(object $request)
    {
        return $request->getRequestType() === HttpKernel::MASTER_REQUEST;
    }
}
