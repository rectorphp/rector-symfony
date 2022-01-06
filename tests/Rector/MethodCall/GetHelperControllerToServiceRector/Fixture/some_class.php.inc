<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetHelperControllerToServiceRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeController extends AbstractController
{
    public function run()
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetHelperControllerToServiceRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SomeController extends AbstractController
{
    public function __construct(private \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    public function run()
    {
        $productRepository = $this->managerRegistry->getRepository(Product::class);
    }
}

?>
