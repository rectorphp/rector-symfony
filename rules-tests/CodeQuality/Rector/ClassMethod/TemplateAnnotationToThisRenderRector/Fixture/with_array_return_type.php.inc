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

    /**
     * @Template("AppBundle:Module:next.html.twig")
     *
     * @return array{items: mixed[]}
     */
    public function list(): array
    {
        return ['items' => []];
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
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('AppBundle:Module:index.html.twig');
    }

    public function list(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('AppBundle:Module:next.html.twig', ['items' => []]);
    }
}

?>
