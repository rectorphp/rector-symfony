<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\ReplaceSensioRouteAnnotationWithSymfonyRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

final class HandleMixture
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route'("/symfony-one")
     * @Route("/sensio-one")
     */
    public function run()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\ReplaceSensioRouteAnnotationWithSymfonyRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

final class HandleMixture
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route'("/symfony-one")
     * @\Symfony\Component\Routing\Annotation\Route("/sensio-one")
     */
    public function run()
    {
    }
}

?>
