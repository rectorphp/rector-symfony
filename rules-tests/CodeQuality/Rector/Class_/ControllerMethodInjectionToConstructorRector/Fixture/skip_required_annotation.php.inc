<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SkipRequiredAnnotation extends AbstractController
{
    private LoggerInterface $logger;

    /**
     * @required
     */
    public function autowire(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
