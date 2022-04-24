<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseRedirect extends WebTestCase
{
    public function test()
    {
        $response = self::$client->getResponse();
        $this->assertSame('https://unknown.com', $response->headers->get('Location'));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseRedirect extends WebTestCase
{
    public function test()
    {
        $response = self::$client->getResponse();
        $this->assertResponseRedirects('https://unknown.com');
    }
}

?>
