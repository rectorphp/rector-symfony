<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InnerReturnWithOnlyVarsController extends AbstractController
{
    /**
     * @Template(vars={"post"})
     */
    public function index(Post $post)
    {
        function (Post $post) {
            return $post;
        };
    }
}

?>
-----
<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InnerReturnWithOnlyVarsController extends AbstractController
{
    public function index(Post $post): \Symfony\Component\HttpFoundation\Response
    {
        function (Post $post) {
            return $post;
        };
        return $this->render('Inner_Return_With_Only_Vars/index.html.twig', ['post' => $post]);
    }
}

?>
