<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

#[\Symfony\Component\Routing\Attribute\Route("/city", name: 'some_name')]
final class KeepClassRouteAttribute extends Controller
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

#[\Symfony\Component\Routing\Attribute\Route(name: 'some_name')]
final class KeepClassRouteAttribute extends Controller
{
    #[\Symfony\Component\Routing\Attribute\Route('/city/street')]
    public function some()
    {
    }
}

?>
