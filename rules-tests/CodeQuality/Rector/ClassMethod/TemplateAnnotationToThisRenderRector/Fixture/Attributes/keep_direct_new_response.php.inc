<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class KeepDirectNewResponse extends AbstractController
{
    #[Template("with_some_template/some_path.twig")]
    public function indexAction(): Response|array
    {
        $item = $this->getItem();

        if (! $item) {
            return new Response('foo');
        }

        $price = 1500;

        return [
            'hello' => 'world',
            'price' => $price,
        ];
    }

    private function getItem(): ?\stdClass
    {
        if (mt_rand(0, 100)) {
            return new \stdClass();
        }

        return null;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\Fixture\Attributes;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class KeepDirectNewResponse extends AbstractController
{
    public function indexAction(): \Symfony\Component\HttpFoundation\Response
    {
        $item = $this->getItem();
        if (! $item) {
            return new Response('foo');
        }
        $price = 1500;
        return $this->render('with_some_template/some_path.twig', [
            'hello' => 'world',
            'price' => $price,
        ]);
    }

    private function getItem(): ?\stdClass
    {
        if (mt_rand(0, 100)) {
            return new \stdClass();
        }

        return null;
    }
}

?>
