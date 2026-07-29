<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony72\Rector\StmtsAwareInterface\PushRequestToRequestStackConstructorRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class TwoRequestStacks extends TestCase
{
    public function testThis()
    {
        $requestStack = new RequestStack();
        $requestStack->push(Request::create('/first'));

        $anotherRequestStack = new RequestStack();
        $anotherRequestStack->push(Request::create('/second'));
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony72\Rector\StmtsAwareInterface\PushRequestToRequestStackConstructorRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class TwoRequestStacks extends TestCase
{
    public function testThis()
    {
        $requestStack = new RequestStack([Request::create('/first')]);

        $anotherRequestStack = new RequestStack([Request::create('/second')]);
    }
}

?>
