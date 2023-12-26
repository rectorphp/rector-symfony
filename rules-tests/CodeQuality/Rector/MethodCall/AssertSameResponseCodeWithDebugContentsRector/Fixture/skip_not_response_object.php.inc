<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\AssertSameResponseCodeWithDebugContentsRector\Fixture;

use PHPUnit\Framework\TestCase;

class SkipNotResponseObjectTest extends TestCase
{
    public function test(object $obj)
    {
        $this->assertSame(200, $obj->getStatusCode());
    }
}
