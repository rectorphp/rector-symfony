<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class WithArrayReturnType extends AbstractController
{
    /**
     * @Template("AppBundle:Module:index.html.twig")
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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class WithArrayReturnType extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('AppBundle:Module:index.html.twig');
    }
}

?>
