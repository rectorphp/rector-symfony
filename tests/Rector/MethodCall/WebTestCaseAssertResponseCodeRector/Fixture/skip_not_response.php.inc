<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Source\NotResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SkipNotResponse extends WebTestCase
{
    public function test()
    {
        $notResponse = new NotResponse();
        $this->assertSame('foo', $notResponse->getStatusCode());
    }
}
