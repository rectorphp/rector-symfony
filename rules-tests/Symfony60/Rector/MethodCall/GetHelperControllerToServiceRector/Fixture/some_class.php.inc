<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\MethodCall\GetHelperControllerToServiceRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeController extends AbstractController
{
    public function run()
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);

        $anotherRepository = $this->getDoctrine()->getRepository(Another::class);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\MethodCall\GetHelperControllerToServiceRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeController extends AbstractController
{
    public function __construct(private \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    public function run()
    {
        $productRepository = $this->managerRegistry->getRepository(Product::class);

        $anotherRepository = $this->managerRegistry->getRepository(Another::class);
    }
}

?>
