<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class UsingConstant extends WebTestCase
{
    public function test()
    {
        $client = $this->client;
        $response = $client->getResponse();
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class UsingConstant extends WebTestCase
{
    public function test()
    {
        $client = $this->client;
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
    }
}

?>
