<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WithStaticAssert extends WebTestCase
{
    public function test()
    {
        self::assertSame(200, $this->client->getResponse()->getStatusCode());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\WebTestCaseAssertIsSuccessfulRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WithStaticAssert extends WebTestCase
{
    public function test()
    {
        self::assertResponseIsSuccessful();
    }
}

?>
