<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

namespace Rector\Tests\Symfony\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

class NotAResponse
{
    public function getStatusCode(): string
    {
        return 'foo';
    }
}

namespace Rector\Tests\Symfony\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

final class SomeClass extends WebTestCase
{
    public function test()
    {       
        $obj = new NotAResponse();
        $this->assertSame('foo', $obj->getStatusCode());
    }
}

?>
-----
<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

namespace Rector\Tests\Symfony\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

class NotAResponse
{
    public function getStatusCode(): string
    {
        return 'foo';
    }
}

namespace Rector\Tests\Symfony\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

final class SomeClass extends WebTestCase
{
    public function test()
    {       
        $obj = new NotAResponse();
        $this->assertSame('foo', $obj->getStatusCode());
    }
}

?>
