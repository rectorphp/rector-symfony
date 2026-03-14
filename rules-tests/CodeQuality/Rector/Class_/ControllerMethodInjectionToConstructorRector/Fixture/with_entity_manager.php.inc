<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class WithentityManager extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(EntityManagerInterface $entityManager)
    {
        $entityManager->flush();
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class WithentityManager extends AbstractController
{
    public function __construct(private readonly \Doctrine\ORM\EntityManagerInterface $entityManager)
    {
    }
    #[Route('/some-action', name: 'some_action')]
    public function someAction()
    {
        $this->entityManager->flush();
    }
}

?>
