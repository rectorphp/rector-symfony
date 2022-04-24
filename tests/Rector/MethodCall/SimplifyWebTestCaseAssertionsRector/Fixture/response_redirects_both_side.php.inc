<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SimplifyWebTestCaseAssertionsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseRedirectBothSide extends WebTestCase
{
    public function testTop()
    {
        $this->assertSame(301, $this->client->getResponse()->getStatusCode());
        $this->assertSame('https://example.com', $this->client->getResponse()->headers->get('Location'));
    }

    public function testBottom()
    {
        $this->assertSame('https://example.com', $this->client->getResponse()->headers->get('Location'));
        $this->assertSame(301, $this->client->getResponse()->getStatusCode());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SimplifyWebTestCaseAssertionsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ResponseRedirectBothSide extends WebTestCase
{
    public function testTop()
    {
        $this->assertResponseRedirects('https://example.com', 301);
    }

    public function testBottom()
    {
        $this->assertResponseRedirects('https://example.com', 301);
    }
}

?>
