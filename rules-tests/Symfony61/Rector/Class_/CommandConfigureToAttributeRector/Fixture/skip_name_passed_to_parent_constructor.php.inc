<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

final class SkipNamePassedToParentConstructorCommand extends Command
{
    public function __construct(?string $name = 'app:some')
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setDescription('Some description');
    }
}
