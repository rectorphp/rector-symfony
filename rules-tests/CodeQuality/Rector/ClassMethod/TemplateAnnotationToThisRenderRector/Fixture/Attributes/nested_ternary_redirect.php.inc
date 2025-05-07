<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class NestedTernaryRedirect extends AbstractController
{
    #[Template("with_some_template.twig")]
    public function indexAction()
    {
        return mt_rand(0, 5) ? $this->redirectToRoute('one') : $this->redirectToRoute('two');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class NestedTernaryRedirect extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        return mt_rand(0, 5) ? $this->redirectToRoute('one') : $this->redirectToRoute('two');
    }
}

?>
