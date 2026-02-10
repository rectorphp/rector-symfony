<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipDateTime extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(DateTimeImmutable $d)
    {
    }
}

?>