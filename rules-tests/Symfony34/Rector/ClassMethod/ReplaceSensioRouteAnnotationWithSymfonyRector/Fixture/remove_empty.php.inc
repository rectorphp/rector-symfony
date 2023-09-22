<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\ReplaceSensioRouteAnnotationWithSymfonyRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/", service="some_service")
 */
final class RemoveEmpty
{
    public function run()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\ReplaceSensioRouteAnnotationWithSymfonyRector\Fixture;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

final class RemoveEmpty
{
    public function run()
    {
    }
}

?>
