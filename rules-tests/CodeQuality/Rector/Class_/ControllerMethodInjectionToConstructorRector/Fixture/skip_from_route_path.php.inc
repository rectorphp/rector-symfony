<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class SkipFromRoutePath extends AbstractController
{
    #[Route(path: '/edit/{id}', name: 'edit')]
    public function someAction(Request $request, ?string $id = null)
    {
    }
}
