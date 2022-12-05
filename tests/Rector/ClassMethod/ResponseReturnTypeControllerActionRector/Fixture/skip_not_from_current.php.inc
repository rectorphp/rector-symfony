<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipNotFromCurrentController extends AbstractController
{
    public function __construct(private RedirectManager $redirectManager)
    {
    }

    #[Route]
    public function redirect()
    {
        return $this->redirectManager->redirect('/');
    }
}

class RedirectManager
{
    public function redirect($url)
    {
        return $url;
    }
}
