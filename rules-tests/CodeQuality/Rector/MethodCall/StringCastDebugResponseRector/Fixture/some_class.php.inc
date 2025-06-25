<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\StringCastDebugResponseRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class SomeClass extends TestCase
{
    public function test(Response $response)
    {
        $this->assertSame(200, $response->getStatusCode(), $response->getContent());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\StringCastDebugResponseRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class SomeClass extends TestCase
{
    public function test(Response $response)
    {
        $this->assertSame(200, $response->getStatusCode(), (string) $response->getContent());
    }
}

?>
