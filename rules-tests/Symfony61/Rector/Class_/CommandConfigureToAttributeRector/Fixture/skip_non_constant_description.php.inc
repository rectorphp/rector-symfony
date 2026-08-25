<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

class SkipNonConstantDescriptionCommand extends Command
{
    public function __construct(private readonly string $description)
    {
    }

    public function configure(): void
    {
        $this->setDescription($this->description);
    }
}
