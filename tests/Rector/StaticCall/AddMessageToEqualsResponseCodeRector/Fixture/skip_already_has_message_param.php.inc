<?php

namespace Rector\Symfony\Tests\Rector\StaticCall\AddMessageToEqualsResponseCodeRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class SkipAlreadyHasMessageParam extends TestCase
{
    public function test(Response $response)
    {
        $this->assertEquals(
            Response::HTTP_NO_CONTENT,
            $response->getStatusCode(),
            'Custom message'
        );
    }
}

?>
