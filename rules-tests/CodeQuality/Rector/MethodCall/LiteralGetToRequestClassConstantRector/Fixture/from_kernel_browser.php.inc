<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FromKernelBrowser extends WebTestCase
{
    public function testSomething(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FromKernelBrowser extends WebTestCase
{
    public function testSomething(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request(\Symfony\Component\HttpFoundation\Request::METHOD_GET, '/');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}

?>
