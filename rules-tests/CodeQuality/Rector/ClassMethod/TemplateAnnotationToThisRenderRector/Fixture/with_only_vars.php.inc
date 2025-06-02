<?php

namespace AppBundle\Controller;

use App\Controller\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WithOnlyVarsController extends AbstractController
{
    /**
     * @Template(vars={"post"})
     */
    public function index(Post $post)
    {
    }

    /**
     * @Template("@SensioBlog/post/show.html.twig", vars={"post"})
     */
    public function list(Post $post): array
    {
        return [];
    }
}

?>
-----
<?php

namespace AppBundle\Controller;

use App\Controller\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WithOnlyVarsController extends AbstractController
{
    public function index(Post $post): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('@App/with_only_vars/index.html.twig', ['post' => $post]);
    }

    public function list(Post $post): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('@SensioBlog/post/show.html.twig', ['post' => $post]);
    }
}

?>
