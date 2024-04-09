<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassWithNamedService55Controller extends AbstractController
{
    /**
     * @Template()
     */
    public function index()
    {
        return [];
    }

    /**
     * @Template()
     */
    public function camelCase()
    {
        return [];
    }
}

?>
-----
<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassWithNamedService55Controller extends AbstractController
{
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('class_with_named_service55/index.html.twig');
    }

    public function camelCase(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('class_with_named_service55/camel_case.html.twig');
    }
}

?>
