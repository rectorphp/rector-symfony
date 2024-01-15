<?php

namespace Rector\Symfony\Tests\DowngradeSymfony70\Rector\Class_\DowngradeSymfonyCommandAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

class SkipSetInConfigure extends Command
{
    protected function configure(): void
    {
        $this->setName('app:create-user');
    }
}
