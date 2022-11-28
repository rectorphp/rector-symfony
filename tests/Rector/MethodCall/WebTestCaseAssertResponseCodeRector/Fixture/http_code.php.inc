<?php

namespace Rector\Tests\Symfony\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HttpCode
{
    public const OK = 200;
    public const CREATED = 201;
    public const FOUND = 302;
}

final class SomeClass extends WebTestCase
{
    public function testFound()
    {
        $response = self::getClient()->getResponse();

        $this->assertSame(302, $response->getStatusCode());
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

        $this->assertSame($expectedHttpCode, $response->getStatusCode(), 'message');
    }

    public function provideDataProvider(): array
    {
        return [
            'success' => ['first.url', HttpCode::OK],
            'fail' => ['second.url', HttpCode::CREATED],
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
    public const OK = 200;
    public const CREATED = 201;
    public const FOUND = 302;
}

final class SomeClass extends WebTestCase
{
    public function testFound()
    {
        $response = self::getClient()->getResponse();

        $this->assertResponseStatusCodeSame(302);
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

        $this->assertResponseStatusCodeSame($expectedHttpCode, 'message');
    }

    public function provideDataProvider(): array
    {
        return [
            'success' => ['first.url', HttpCode::OK],
            'fail' => ['second.url', HttpCode::CREATED],
        ];
    }
}

?>
