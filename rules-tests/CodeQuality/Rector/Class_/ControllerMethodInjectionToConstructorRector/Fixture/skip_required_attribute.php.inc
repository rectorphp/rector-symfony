<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SkipRequiredAttribute extends AbstractController
{
    private LoggerInterface $logger;

    #[Required]
    public function autowire(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}