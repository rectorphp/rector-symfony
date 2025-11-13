<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipScalarAndRequestParams extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(
        \Symfony\Component\HttpFoundation\Request $request,
        int $number
    ) {
    }
}
