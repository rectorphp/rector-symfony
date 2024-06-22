<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class SkipCommandWithAliases extends \Symfony\Component\Console\Command\Command
{
    public function configure(): void
    {
        $this
            ->setAliases(['sun', 'shine']);
    }
}
