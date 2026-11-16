<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\StaticCall\ResponseCreateToNewRector\Fixture;

use Symfony\Component\HttpFoundation\Response;

final class SkipOtherClass
{
    public function run()
    {
        $other = \DateTime::create();
        $response = Response::fromSomething();
    }
}
