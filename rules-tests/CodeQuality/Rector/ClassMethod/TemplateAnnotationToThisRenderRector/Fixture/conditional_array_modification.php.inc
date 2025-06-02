<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ConditionalArrayModification extends AbstractController
{
    /**
     * @Template("with_some_template.twig")
     */
    public function indexAction()
    {
        $response = [
            'hello' => 'world'
        ];

        if (mt_rand(0, 100)) {
            $response['hello 2'] = 'world2';
        }

        return $response;
    }
}

?>
-----
<?php declare (strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ConditionalArrayModification extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        $response = [
            'hello' => 'world'
        ];

        if (mt_rand(0, 100)) {
            $response['hello 2'] = 'world2';
        }

        return $this->render('with_some_template.twig', $response);
    }
}

?>
