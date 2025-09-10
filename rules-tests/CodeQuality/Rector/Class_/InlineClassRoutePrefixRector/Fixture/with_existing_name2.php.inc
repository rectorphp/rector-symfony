<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\InlineClassRoutePrefixRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

#[\Symfony\Component\Routing\Attribute\Route("/city", name: "some_org.")]
final class WithExistingName2 extends Controller
{
    #[\Symfony\Component\Routing\Attribute\Route("/street", name: "some")]
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

#[\Symfony\Component\Routing\Attribute\Route(name: "some_org.")]
final class WithExistingName2 extends Controller
{
    #[\Symfony\Component\Routing\Attribute\Route('/city/street', name: 'some_org.some')]
    public function some()
    {
    }
}

?>
