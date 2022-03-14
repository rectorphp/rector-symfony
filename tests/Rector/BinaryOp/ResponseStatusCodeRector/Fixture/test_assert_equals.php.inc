<?php

namespace Rector\Symfony\Tests\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Client;
use PHPUnit\Framework\TestCase;

class TestAssertEquals extends TestCase
{
    /** @var Client */
    protected $client;

    public function index()
    {
        $this->assertEquals(
            200,
            $this->client->getResponse()
                ->getStatusCode()

        );
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\BinaryOp\ResponseStatusCodeRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Client;
use PHPUnit\Framework\TestCase;

class TestAssertEquals extends TestCase
{
    /** @var Client */
    protected $client;

    public function index()
    {
        $this->assertEquals(
            \Symfony\Component\HttpFoundation\Response::HTTP_OK,
            $this->client->getResponse()
                ->getStatusCode()

        );
    }
}

?>
