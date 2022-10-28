<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\MergeMethodAnnotationToRouteAnnotationRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

class SingleMethodController
{

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

class SingleMethodController
{

    /**
     * @Route("/post/{id}", methods={"POST"})
     */
    public function post($id)
    {
    }
}

?>
