<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\FixtureTypeGuarded;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class FinalController extends AbstractController
{
    #[Route]
    public function detail()
    {
        return $this->render('some_template');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\FixtureTypeGuarded;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class FinalController extends AbstractController
{
    #[Route]
    public function detail(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('some_template');
    }
}

?>
