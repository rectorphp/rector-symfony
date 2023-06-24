<?php

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

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
        $customMessage = 'Custom message';
        $customMessageInt = 1;

        $this->assertSame(302, $response->getStatusCode(), $customMessage);
        $this->assertSame(302, $response->getStatusCode(), (string) $customMessageInt);
        $this->assertSame(HttpCode::FOUND, $response->getStatusCode(), $customMessage);
        $this->assertSame('https://example.com', $response->headers->get('Location'));
        $this->assertSame('https://example.com', $response->headers->get('Location'), $customMessage);
        $this->assertSame('https://example.com', $response->headers->get('Location'), (string) $customMessageInt);
    }

    /**
     * @dataProvider provideDataProvider
     */
    public function testDataProvider(string $url, int $expectedHttpCode)
    {
        $client = self::getClient();
        $client->request('POST', $url);
        $response = $client->getResponse();

        $this->assertSame($expectedHttpCode, $response->getStatusCode(), sprintf('Custom message from url: %s', $url));
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

namespace Rector\Symfony\Tests\Symfony43\Rector\MethodCall\WebTestCaseAssertResponseCodeRector\Fixture;

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
        $customMessage = 'Custom message';
        $customMessageInt = 1;

        $this->assertResponseStatusCodeSame(302, $customMessage);
        $this->assertResponseStatusCodeSame(302, (string) $customMessageInt);
        $this->assertResponseStatusCodeSame(HttpCode::FOUND, $customMessage);
        $this->assertResponseRedirects('https://example.com');
        $this->assertResponseRedirects('https://example.com', null, $customMessage);
        $this->assertResponseRedirects('https://example.com', null, (string) $customMessageInt);
    }

    /**
     * @dataProvider provideDataProvider
     */
    public function testDataProvider(string $url, int $expectedHttpCode)
    {
        $client = self::getClient();
        $client->request('POST', $url);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame($expectedHttpCode, sprintf('Custom message from url: %s', $url));
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
