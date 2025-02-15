<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/city")
 */
final class ExplicitSilentMix extends Controller
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

final class ExplicitSilentMix extends Controller
{
    /**
     * @Route("/city/street")
     */
    public function some()
    {
    }
}

?>
