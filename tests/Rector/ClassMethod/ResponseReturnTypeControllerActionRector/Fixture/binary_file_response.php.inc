<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class BinaryFileResponse extends AbstractController
{
    #[Route]
    public function fileAction()
    {
        return $this->file('some_template');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class BinaryFileResponse extends AbstractController
{
    #[Route]
    public function fileAction(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return $this->file('some_template');
    }
}

?>
