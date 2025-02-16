<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

#[\Symfony\Component\Routing\Attribute\Route("/city")]
final class AttributeRoutingWithOtherAnnotation extends Controller
{
    /**
     * @return string
     */
    #[\Symfony\Component\Routing\Attribute\Route("/street")]
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

final class AttributeRoutingWithOtherAnnotation extends Controller
{
    /**
     * @return string
     */
    #[\Symfony\Component\Routing\Attribute\Route('/city/street')]
    public function some()
    {
    }
}

?>
