<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseCodeSame extends WebTestCase
{
    public function test()
    {
        $response = self::$client->getResponse();
        $this->assertSame(362, $response->getStatusCode());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseCodeSame extends WebTestCase
{
    public function test()
    {
        $response = self::$client->getResponse();
        $this->assertResponseStatusCodeSame(362);
    }
}

?>
