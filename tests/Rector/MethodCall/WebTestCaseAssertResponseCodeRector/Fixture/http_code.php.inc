<?php

namespace Rector\Tests\Symfony\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HttpCode
{
    public const FOUND = 301;
}

final class SomeClass extends WebTestCase
{
    public function test()
    {
        $client = self::getClient();
        $client->request('POST', 'some.url');
        $response = $client->getResponse();

        $this->assertSame(301, $response->getStatusCode());
        $this->assertSame(HttpCode::FOUND, $response->getStatusCode());
        $this->assertSame('https://example.com', $response->headers->get('Location'));
    }

    /**
     * @dataProvider provideDataProvider
     */
    public function testDataProvider(string $url, int $expectedHttpCode)
    {
        $client = self::getClient();
        $client->request('POST', $url);
        $response = $client->getResponse();

        $this->assertSame($expectedHttpCode, $response->getStatusCode());
    }

    public function provideDataProvider(): array
    {
        return [
            'success' => ['first.url', 200],
            'fail' => ['second.url', 301],
        ];
    }
}

?>
-----
<?php

namespace Rector\Tests\Symfony\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HttpCode
{
    public const FOUND = 301;
}

final class SomeClass extends WebTestCase
{
    public function test()
    {
        $client = self::getClient();
        $client->request('POST', 'some.url');
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(301);
        $this->assertResponseStatusCodeSame(HttpCode::FOUND);
        $this->assertResponseRedirects('https://example.com');
    }

    /**
     * @dataProvider provideDataProvider
     */
    public function testDataProvider(string $url, int $expectedHttpCode)
    {
        $client = self::getClient();
        $client->request('POST', $url);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame($expectedHttpCode);
    }

    public function provideDataProvider(): array
    {
        return [
            'success' => ['first.url', 200],
            'fail' => ['second.url', 301],
        ];
    }
}

?>
