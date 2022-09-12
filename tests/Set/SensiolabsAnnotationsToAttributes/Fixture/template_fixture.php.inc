<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BarController
{
    /**
     * @Template("@Blog/post.html.twig")
     */
    public function foo()
    {
    }
}

?>
-----
<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BarController
{
    #[Template('@Blog/post.html.twig')]
    public function foo()
    {
    }
}

?>
