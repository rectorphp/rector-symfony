<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class SkipArrayAndResponseWithArrayController extends AbstractController
{
    /**
     * @Template("with_some_template.twig")
     */
    public function indexAction()
    {
        return $this->handleStuff([
            'a' => 'b'
        ]);
    }

    /**
     * @return array|RedirectResponse
     */
    private function handleStuff(...$args)
    {
        if (mt_rand(0, 100)) {
            return [
                'hello' => 'world'
            ];
        }

        return new RedirectResponse('elsewhere');
    }
}
