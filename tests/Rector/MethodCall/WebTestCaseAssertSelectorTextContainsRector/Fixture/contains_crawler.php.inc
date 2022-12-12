<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertSelectorTextContainsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ContainsCrawler extends WebTestCase
{
    public function testContains()
    {
        $crawler = self::getClient()->getCrawler();
        $this->assertContains('Hello World', $crawler->filter('h1')->text(), sprintf('Custom message: %s', 'custom message'));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertSelectorTextContainsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ContainsCrawler extends WebTestCase
{
    public function testContains()
    {
        $crawler = self::getClient()->getCrawler();
        $this->assertSelectorTextContains('h1', 'Hello World', sprintf('Custom message: %s', 'custom message'));
    }
}

?>
