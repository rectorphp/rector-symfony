<?php

namespace AppBundle\Controller;

use App\Controller\Post;
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

namespace AppBundle\Controller;

use App\Controller\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InnerReturnWithOnlyVarsController extends AbstractController
{
    public function index(Post $post): \Symfony\Component\HttpFoundation\Response
    {
        function (Post $post) {
            return $post;
        };
        return $this->render('@App/Inner_Return_With_Only_Vars/index.html.twig', ['post' => $post]);
    }
}

?>
