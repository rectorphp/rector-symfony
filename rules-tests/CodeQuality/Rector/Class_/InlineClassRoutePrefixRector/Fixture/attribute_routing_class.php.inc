<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

#[\Symfony\Component\Routing\Attribute\Route("/city")]
final class AttributeRoutingClass extends Controller
{
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

final class AttributeRoutingClass extends Controller
{
    #[\Symfony\Component\Routing\Attribute\Route('/city/street')]
    public function some()
    {
    }
}

?>
