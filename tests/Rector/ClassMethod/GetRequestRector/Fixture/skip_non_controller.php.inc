<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\Rector\ClassMethod\GetRequestRector\Fixture;

use Symfony\Component\HttpFoundation\Request;

final class SkipNonController
{
    public function createSandbox()
    {
        $request = $this->getRequest();
    }

    private function getRequest()
    {
        return new Request();
    }
}
