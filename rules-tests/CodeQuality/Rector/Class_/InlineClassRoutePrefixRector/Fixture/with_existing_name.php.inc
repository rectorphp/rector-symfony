<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/city", name="some_org.")
 */
final class WithExistingName extends Controller
{
    /**
     * @Route("/street", name="some")
     */
    public function some()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

final class WithExistingName extends Controller
{
    /**
     * @Route("/city/street", name="some_org.some")
     */
    public function some()
    {
    }
}

?>
