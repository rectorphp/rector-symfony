<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseCodeSame extends WebTestCase
{
    public function test()
    {
        $response = self::$client->getResponse();
        self::assertSame(362, $response->getStatusCode());
        self::assertSame('https://unknown.com', $response->headers->get('Location'));
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
        self::assertResponseStatusCodeSame(362);
        self::assertResponseRedirects('https://unknown.com');
    }
}

?>
