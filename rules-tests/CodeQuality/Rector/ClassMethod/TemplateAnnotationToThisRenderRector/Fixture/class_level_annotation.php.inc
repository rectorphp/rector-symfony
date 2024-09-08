<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Template("items_template")
 */
final class ClassLevelAnnotation extends AbstractController
{
    public function indexAction()
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

final class ClassLevelAnnotation extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('items_template');
    }
}

?>
