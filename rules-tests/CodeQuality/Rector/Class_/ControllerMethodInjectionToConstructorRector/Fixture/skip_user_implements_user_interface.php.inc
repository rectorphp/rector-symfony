<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\SomeUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipUserImplementsUserInterface extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(SomeUser $user)
    {
    }
}
