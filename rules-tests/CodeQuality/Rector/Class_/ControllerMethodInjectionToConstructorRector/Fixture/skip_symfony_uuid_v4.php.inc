<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Uid\UuidV4;

final class SkipSymfonyUuidV4 extends AbstractController
{
    public function someAction(UuidV4 $uuid)
    {
    }
}
