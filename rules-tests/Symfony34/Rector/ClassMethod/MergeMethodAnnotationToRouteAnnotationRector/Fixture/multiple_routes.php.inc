<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

class MultipleRoutes
{
    /**
     * @Route("/first")
     * @Route("/second")
     * @Method({"POST"})
     */
    public function show($id)
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

class MultipleRoutes
{
    /**
     * @Route("/first", methods={"POST"})
     * @Route("/second", methods={"POST"})
     */
    public function show($id)
    {
    }
}

?>
