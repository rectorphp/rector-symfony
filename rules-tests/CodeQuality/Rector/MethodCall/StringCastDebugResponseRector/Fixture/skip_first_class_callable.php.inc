<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\StringCastDebugResponseRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class SkipFirstClassCallable extends TestCase
{
    public function test(Response $response)
    {
        $this->assertSame(...);
    }
}
