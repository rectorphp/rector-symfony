<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony72\Rector\StmtsAwareInterface\PushRequestToRequestStackConstructorRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class SkipOutsideTestCase
{
    public function run()
    {
        $requestStack = new RequestStack();
        $requestStack->push(Request::create('/'));
    }
}
