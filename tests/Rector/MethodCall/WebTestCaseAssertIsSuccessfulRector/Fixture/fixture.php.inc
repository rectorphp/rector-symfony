<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SomeClass extends WebTestCase
{
    public function test()
    {
        $this->assertSame(200, $this->client->getResponse()->getStatusCode(), 'Custom message');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SomeClass extends WebTestCase
{
    public function test()
    {
        $this->assertResponseIsSuccessful('Custom message');
    }
}

?>
