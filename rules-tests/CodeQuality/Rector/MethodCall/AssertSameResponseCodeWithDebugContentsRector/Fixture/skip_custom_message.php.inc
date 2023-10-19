<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\AssertSameResponseCodeWithDebugContentsRector\Fixture;

use PHPUnit\Framework\TestCase;

class SkipCustomMessage extends TestCase
{
    public function test()
    {
        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $this->processResult();

        $this->assertSame(200, $response->getStatusCode(), 'custom message');
    }
}
