<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WithoutBaseClass
{
    /**
     * @Route("/change", name="facility_change")
     * @Template("AppBundle:ClassWithNamedService25:index.html.twig")
     */
    public function index()
    {
        return [];
    }
}

?>
-----
<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WithoutBaseClass extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/change", name="facility_change")
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('AppBundle:ClassWithNamedService25:index.html.twig');
    }
}

?>
