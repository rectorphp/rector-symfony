<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class RedirectResponse extends AbstractController
{
    #[Route]
    public function detail()
    {
        return $this->redirectToRoute('some_template');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class RedirectResponse extends AbstractController
{
    #[Route]
    public function detail(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return $this->redirectToRoute('some_template');
    }
}

?>
