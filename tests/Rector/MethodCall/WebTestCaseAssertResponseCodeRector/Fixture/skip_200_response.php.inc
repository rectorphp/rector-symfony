<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Source\NotResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class Skip200Response extends WebTestCase
{
    public function test()
    {
        $response = self::$client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
    }
}
