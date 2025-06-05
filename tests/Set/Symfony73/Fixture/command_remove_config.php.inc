<?php

namespace Rector\Symfony\Tests\Set\Symfony73\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class SomeCommand extends Command
{
    public function configure()
    {
        $this->setHelp(
            'The <info>%command.name%</info> command will do some
        argument passed to it:

        <info>php %command.full_name% argument</info>'
        );
        $this->addArgument('argument', InputArgument::REQUIRED, 'Argument description');
        $this->addOption('option', 'o', InputOption::VALUE_NONE, 'Option description');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $someArgument = $input->getArgument('argument');
        $someOption = $input->getOption('option');

        // ...

        return 1;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony73\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name', help: <<<'TXT'
The <info>%command.name%</info> command will do some
        argument passed to it:

        <info>php %command.full_name% argument</info>
TXT)]
final class SomeCommand
{
    public function __invoke(#[\Symfony\Component\Console\Attribute\Argument(name: 'argument', description: 'Argument description')]
    string $argument, #[\Symfony\Component\Console\Attribute\Option]
    $option, OutputInterface $output): int
    {
        $someArgument = $argument;
        $someOption = $option;

        // ...

        return 1;
    }
}

?>
