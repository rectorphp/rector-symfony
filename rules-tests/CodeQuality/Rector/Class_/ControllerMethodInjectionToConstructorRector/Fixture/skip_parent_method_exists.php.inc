<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\IntermediateController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipParentMethodExists extends IntermediateController
{
    public function __construct()
    {
    }

    #[Route('/some-action', name: 'some_action')]
    public function someAction(LoggerInterface $logger)
    {
        $someClosure = function () use ($logger) {
            $logger->log('level', 'value');
        };
    }
}

?>