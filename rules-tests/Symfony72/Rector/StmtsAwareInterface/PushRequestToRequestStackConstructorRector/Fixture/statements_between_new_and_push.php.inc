<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony72\Rector\StmtsAwareInterface\PushRequestToRequestStackConstructorRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class StatementsBetweenNewAndPush extends TestCase
{
    public function testThis()
    {
        $requestStack = new RequestStack();
        $request = new Request();
        $request->setLocale('fr');
        $requestStack->push($request);
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

final class StatementsBetweenNewAndPush extends TestCase
{
    public function testThis()
    {
        $request = new Request();
        $request->setLocale('fr');
        $requestStack = new RequestStack([$request]);
    }
}

?>
