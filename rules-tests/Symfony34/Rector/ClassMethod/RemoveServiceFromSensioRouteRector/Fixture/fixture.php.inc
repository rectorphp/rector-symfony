<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\RemoveServiceFromSensioRouteRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

final class SomeClass
{
    /**
     * @Route(service="some_service")
     */
    public function run()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\RemoveServiceFromSensioRouteRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

final class SomeClass
{
    /**
     * @Route
     */
    public function run()
    {
    }
}

?>
