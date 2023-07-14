<?php

namespace Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

class DoubleRouteController
{
    public function show()
    {
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Configs\Rector\ClassMethod\AddRouteAnnotationRector\Fixture;

class DoubleRouteController
{
    /**
     * @\Symfony\Component\Routing\Annotation\Route(path="/some-path", name="double_route_1")
     * @\Symfony\Component\Routing\Annotation\Route(path="/some-path", name="double_route_2")
     */
    public function show()
    {
    }
}
?>
