<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class OptionalOptionBeforeRequired extends Command
{
    public function configure()
    {
        $this->addOption('option', 'o', InputOption::VALUE_NONE, 'Option description');
        $this->addOption('another', 'a', InputOption::VALUE_REQUIRED, 'No default value');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $someOption = $input->getOption('option');
        $another = $input->getOption('another');

        // ...

        return 1;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class OptionalOptionBeforeRequired
{
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Option(name: 'another', shortcut: 'a', mode: InputOption::VALUE_REQUIRED, description: 'No default value')]
        $another,
        #[\Symfony\Component\Console\Attribute\Option(name: 'option', shortcut: 'o', mode: InputOption::VALUE_NONE, description: 'Option description')]
        bool $option = false
    ): int
    {
        $someOption = $option;
        $another = $another;
        // ...
        return 1;
    }
}

?>
