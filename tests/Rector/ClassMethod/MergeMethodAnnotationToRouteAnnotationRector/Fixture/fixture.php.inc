<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/show/{id}")
     * @Method({"GET", "HEAD"})
     */
    public function show($id)
    {
    }

    /**
     * @Route("/post/{id}")
     * @Method("POST")
     */
    public function post($id)
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/show/{id}", methods={"GET", "HEAD"})
     */
    public function show($id)
    {
    }

    /**
     * @Route("/post/{id}", methods={"POST"})
     */
    public function post($id)
    {
    }
}

?>
