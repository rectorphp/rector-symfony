<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class Skip200ConstantResponse extends WebTestCase
{
    public function test()
    {
        $response = self::$client->getResponse();
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
    }
}

?>
