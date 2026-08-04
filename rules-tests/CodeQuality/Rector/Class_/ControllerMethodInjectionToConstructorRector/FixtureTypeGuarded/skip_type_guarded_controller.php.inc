<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\FixtureTypeGuarded;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\AbstractCustomController;
use Symfony\Component\Routing\Annotation\Route;

class SkipTypeGuardedController extends AbstractCustomController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(LoggerInterface $logger)
    {
        $logger->log('level', 'value');
    }
}
