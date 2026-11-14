<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

final class SkipFirstClassCallableCommand extends Command
{
    protected function configure(): void
    {
        $setDescription = $this->setDescription(...);
        $setDescription('Some description');
    }
}
