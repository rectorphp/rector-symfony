<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DemoController extends AbstractController
{
    public function __construct(
        private readonly UpdateAppContext $context // This is not the same service as AdminContext
    ) {
    }

    public function __invoke(AdminContext $context): int
    {
       return $context->getNumber(); // This is not the same service as UpdateAppContext
    }
}