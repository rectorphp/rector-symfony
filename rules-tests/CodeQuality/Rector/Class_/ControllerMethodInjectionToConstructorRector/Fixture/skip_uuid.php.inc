<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class SkipUser extends AbstractController
{
    #[Route('/some-action/{id}', name: 'some_action')]
    public function someAction(Uuid $id)
    {
    }
}
