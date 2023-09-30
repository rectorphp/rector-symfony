<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class ContainerAwareCommand extends Command
{
    private string $something;

    public function __construct()
    {
        $this->something = 'someValue';
    }

    public function getContainer(): ContainerInterface
    {
    }
}
