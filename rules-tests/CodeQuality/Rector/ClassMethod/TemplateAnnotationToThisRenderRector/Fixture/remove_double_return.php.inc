<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

final class RemoveDoubleReturn extends AbstractController
{
    /**
     * @Template("AppBundle:Module:next.html.twig")
     *
     * @return Response
     *
     * @return array
     */
    public function indexAction(): array
    {
        return [];
    }
}

?>
-----
<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

final class RemoveDoubleReturn extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('AppBundle:Module:next.html.twig');
    }
}

?>
