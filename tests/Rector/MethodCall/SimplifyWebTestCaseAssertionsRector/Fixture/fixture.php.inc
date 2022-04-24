<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SimplifyWebTestCaseAssertionsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SomeClass extends WebTestCase
{
    public function testContains()
    {
        $this->assertContains('Hello World', $crawler->filter('h1')->text());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SimplifyWebTestCaseAssertionsRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SomeClass extends WebTestCase
{
    public function testContains()
    {
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}

?>
