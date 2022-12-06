<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

final class TemplateController extends AbstractController
{
    #[Route]
    #[Template]
    public function testDetail()
    {
        return [];
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

final class TemplateController extends AbstractController
{
    #[Route]
    #[Template]
    public function testDetail(): ?array
    {
        return [];
    }
}
?>
