<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

final class SkipPossibleReturnArrayOrResponseNonNative extends AbstractController
{
    /**
     * @Route("/new", name="some_new")
     *
     * @Template(template="Foo:Bar:edit.html.twig")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array{x: xy, form: \Symfony\Component\Form\FormView}
     */
    public function newAction()
    {
        $form = $this->createForm(Some::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->someRedirect();
        }

        return [
            'x' => 'xy',
            'form' => $form->createView(),
        ];
    }

    private function someRedirect()
    {
        return $this->redirect($this->generateUrl('some'));
    }
}
