<?php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceFormCreateViewFunctionCall extends AbstractController
{
    #[Route('/form', name: 'form')]
    public function form(): Response
    {
        $form = $this->createFormBuilder()->getForm();
        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

?>
-----
<?php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceFormCreateViewFunctionCall extends AbstractController
{
    #[Route('/form', name: 'form')]
    public function form(): Response
    {
        $form = $this->createFormBuilder()->getForm();
        return $this->render('form.html.twig', [
            'form' => $form,
        ]);
    }
}

?>
