<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AssignVariable extends WebTestCase
{
    public function test()
    {
        $client = $this->client;
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AssignVariable extends WebTestCase
{
    public function test()
    {
        $client = $this->client;
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
    }
}

?>
