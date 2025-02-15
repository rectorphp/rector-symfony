<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/city")
 */
final class SomeRoutingClass extends Controller
{
    /**
     * @Route("/street")
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

final class SomeRoutingClass extends Controller
{
    /**
     * @Route("/city/street")
     */
    public function some()
    {
    }
}

?>
