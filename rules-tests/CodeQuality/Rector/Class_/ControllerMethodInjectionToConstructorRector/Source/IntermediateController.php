<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;

class IntermediateController extends AbstractController
{
    #[Route('/some-action', name: 'some_action')]
    public function someAction(LoggerInterface $logger)
    {
        // to be overridden
    }
}
