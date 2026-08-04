<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

final class SkipSessionInterface extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(SessionInterface $session)
    {
        $session->invalidate();
    }
}
