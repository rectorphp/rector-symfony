<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/city")
 */
final class InversedExplicitSilentMix extends Controller
{
    /**
     * @Route(path="/street")
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

final class InversedExplicitSilentMix extends Controller
{
    /**
     * @Route(path="/city/street")
     */
    public function some()
    {
    }
}

?>
