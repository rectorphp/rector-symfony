<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseRedirectBothSide extends WebTestCase
{
    public function testTop()
    {
        $this->assertSame(301, self::$client->getResponse()->getStatusCode());
        $this->assertSame('https://example.com', self::$client->getResponse()->headers->get('Location'));
    }

    public function testBottom()
    {
        $this->assertSame('https://example2.com', self::$client->getResponse()->headers->get('Location'));
        $this->assertSame(302, self::$client->getResponse()->getStatusCode());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseRedirectBothSide extends WebTestCase
{
    public function testTop()
    {
        $this->assertResponseStatusCodeSame(301);
        $this->assertResponseRedirects('https://example.com');
    }

    public function testBottom()
    {
        $this->assertResponseRedirects('https://example2.com');
        $this->assertResponseStatusCodeSame(302);
    }
}

?>
