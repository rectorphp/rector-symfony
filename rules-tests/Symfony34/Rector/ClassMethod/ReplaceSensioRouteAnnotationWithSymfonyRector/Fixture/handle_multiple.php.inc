<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\ReplaceSensioRouteAnnotationWithSymfonyRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

final class HandleMultiple
{
    /**
     * @Route("/first")
     * @Route("/second")
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

final class HandleMultiple
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route("/first")
     * @\Symfony\Component\Routing\Annotation\Route("/second")
     */
    public function run()
    {
    }
}

?>
