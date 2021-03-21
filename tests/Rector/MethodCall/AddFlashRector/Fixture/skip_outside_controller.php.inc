<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AddFlashRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

class SkipOutsideController
{
    public function someAction(Request $request)
    {
        $request->getSession()->getFlashBag()->add('success', 'message');
    }
}
