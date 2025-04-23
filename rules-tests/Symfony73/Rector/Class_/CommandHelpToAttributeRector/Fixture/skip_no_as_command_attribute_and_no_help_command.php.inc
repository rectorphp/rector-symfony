<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\CommandHelpToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

final class SkipNoAsCommandAttributeAndNoHelpAttributeCommand extends Command
{
    public function configure()
    {
        $this->setName('Some command');
    }
}

?>
