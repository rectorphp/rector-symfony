<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class StreamedResponse extends AbstractController
{
    #[Route]
    public function streamAction()
    {
        return $this->stream('stream');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class StreamedResponse extends AbstractController
{
    #[Route]
    public function streamAction(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return $this->stream('stream');
    }
}

?>
