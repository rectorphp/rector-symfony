<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertSelectorTextContainsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HandleStaticCalls extends WebTestCase
{
    public function testContains()
    {
        $crawler = self::getClient()->getCrawler();
        self::assertContains('Hello World', $crawler->filter('h1')->text(), 'Custom message');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertSelectorTextContainsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HandleStaticCalls extends WebTestCase
{
    public function testContains()
    {
        $crawler = self::getClient()->getCrawler();
        self::assertSelectorTextContains('h1', 'Hello World', 'Custom message');
    }
}

?>
