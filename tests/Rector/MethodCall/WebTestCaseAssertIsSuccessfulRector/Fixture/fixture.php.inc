<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SomeClass extends WebTestCase
{
    public function test()
    {
        $this->assertSame(200, $this->client->getResponse()->getStatusCode(), sprintf('Custom message: %s', 'Custom message'));
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
        $this->assertResponseIsSuccessful(sprintf('Custom message: %s', 'Custom message'));
    }
}

?>
