<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\CommandHelpToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class ConcatenatedHelpStringCommand extends Command
{
    public function configure()
    {
        $this
            ->setHelp("First line of help.\n"
                . "Second line of help.\n"
                . "Third line of help.")
            ->addOption('run', null, InputOption::VALUE_NONE, 'Run mode');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\CommandHelpToAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name', help: <<<'TXT'
First line of help.
Second line of help.
Third line of help.
TXT)]
final class ConcatenatedHelpStringCommand extends Command
{
    public function configure()
    {
        $this
            ->addOption('run', null, InputOption::VALUE_NONE, 'Run mode');
    }
}

?>
