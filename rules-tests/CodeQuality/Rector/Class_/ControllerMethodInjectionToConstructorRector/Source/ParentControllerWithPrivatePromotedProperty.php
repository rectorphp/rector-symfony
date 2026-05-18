<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class ParentControllerWithPrivatePromotedProperty extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }
}
