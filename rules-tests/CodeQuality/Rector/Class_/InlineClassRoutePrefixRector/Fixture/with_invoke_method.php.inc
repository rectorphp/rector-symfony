<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/city", name="some_org.")
 */
final class WithInvokeMethod extends Controller
{
    /**
     * @Route("/street", name="some")
     */
    public function __invoke()
    {
    }
}

?>
    -----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class WithInvokeMethod extends Controller
{
    /**
     * @Route("/city/street", name="some_org.some")
     */
    public function __invoke()
    {
    }
}

?>
