<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class RemoveAttributeButKeepJsonResponseReversed extends AbstractController
{
    #[Template("with_some_template.twig")]
    public function indexAction(): array|Response
    {
        if (mt_rand(0, 1)) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        return ['key' => 'value'];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class RemoveAttributeButKeepJsonResponseReversed extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        if (mt_rand(0, 1)) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }
        return $this->render('with_some_template.twig', ['key' => 'value']);
    }
}

?>
