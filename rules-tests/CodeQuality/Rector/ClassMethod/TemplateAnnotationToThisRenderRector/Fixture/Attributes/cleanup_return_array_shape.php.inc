<?php

namespace AppBundle\Controller\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CleanupArrayReturnShape extends AbstractController
{
    /**
     * @return array{hello: string}
     */
    #[Template("with_some_template.twig")]
    public function indexAction()
    {
        return [
            'hello' => 'world'
        ];
    }
}

?>
-----
<?php

namespace AppBundle\Controller\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CleanupArrayReturnShape extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('with_some_template.twig', [
            'hello' => 'world'
        ]);
    }
}

?>
