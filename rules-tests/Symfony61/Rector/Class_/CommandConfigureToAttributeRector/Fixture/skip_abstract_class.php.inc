<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandConfigureToAttributeRector\Fixture;

use Symfony\Component\Console\Command\Command;

abstract class SkipAbstractClass extends Command
{
    public function configure()
    {
    }
}
