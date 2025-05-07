<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class NestedTernaryRedirectThenArray extends AbstractController
{
    #[Template("with_some_template.twig")]
    public function indexAction()
    {
        if (isset($value)) {
            return mt_rand(0, 5) ? $this->redirectToRoute('one') : $this->redirectToRoute('two');
        }

        return [
            'key' => 'value'
        ];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class NestedTernaryRedirectThenArray extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        if (isset($value)) {
            return mt_rand(0, 5) ? $this->redirectToRoute('one') : $this->redirectToRoute('two');
        }
        return $this->render('with_some_template.twig', [
            'key' => 'value'
        ]);
    }
}

?>
