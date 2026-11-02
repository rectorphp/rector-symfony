<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

final class SkipNonConstantNameCommand extends Command
{
    public function __construct(private readonly string $commandName)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName($this->commandName);
        $this->setDescription('Some description');
    }
}
