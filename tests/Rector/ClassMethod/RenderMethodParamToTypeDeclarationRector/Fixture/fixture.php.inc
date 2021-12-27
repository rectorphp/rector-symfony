<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RenderMethodParamToTypeDeclarationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SomeClass extends AbstractController
{
    /**
     * @param string $name
     */
    #[Route]
    public function run($name)
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RenderMethodParamToTypeDeclarationRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SomeClass extends AbstractController
{
    #[Route]
    public function run(string $name)
    {
    }
}

?>
