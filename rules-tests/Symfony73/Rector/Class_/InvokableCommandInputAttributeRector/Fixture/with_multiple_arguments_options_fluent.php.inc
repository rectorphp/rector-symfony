<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'some_name')]
final class WithMultipleArgumentsOptionsFluent extends Command
{
    public function configure()
    {
        $this
            ->addArgument('argument1', InputArgument::REQUIRED, 'Argument1 description')
            ->addArgument('argument2', InputArgument::REQUIRED, 'Argument2 description')
            ->addOption('option1', 'o', InputOption::VALUE_NONE, 'Option1 description')
            ->addOption('option2', 'p', InputOption::VALUE_NONE, 'Option2 description')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $arg1 = $input->getArgument('argument1');
        $arg2 = $input->getArgument('argument2');
        $opt1 = $input->getOption('option1');
        $opt2 = $input->getOption('option2');

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
final class WithMultipleArgumentsOptionsFluent
{
    public function __invoke(
        #[\Symfony\Component\Console\Attribute\Argument(name: 'argument1', description: 'Argument1 description')]
        string $argument1,
        #[\Symfony\Component\Console\Attribute\Argument(name: 'argument2', description: 'Argument2 description')]
        string $argument2,
        #[\Symfony\Component\Console\Attribute\Option(name: 'option1', shortcut: 'o', mode: InputOption::VALUE_NONE, description: 'Option1 description')]
        $option1,
        #[\Symfony\Component\Console\Attribute\Option(name: 'option2', shortcut: 'p', mode: InputOption::VALUE_NONE, description: 'Option2 description')]
        $option2
    ): int
    {
        $arg1 = $argument1;
        $arg2 = $argument2;
        $opt1 = $option1;
        $opt2 = $option2;
        // ...
        return 1;
    }
}

?>
