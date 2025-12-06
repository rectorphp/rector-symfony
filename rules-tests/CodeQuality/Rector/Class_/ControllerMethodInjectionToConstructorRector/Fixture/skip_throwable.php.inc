<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

// override of symfony error controller
// @see https://symfony.com/doc/current/controller/error_pages.html#overriding-the-default-errorcontroller

final class SkipThrowable extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(
        \Exception $exception
    ) {
    }
}
